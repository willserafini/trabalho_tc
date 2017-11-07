<?php

namespace App\Controller;

use App\Controller\AreaAlunoController;
use Cake\Event\Event;
use App\Lib\IdentificarECA;
use App\Model\Table\AlunosTable;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;

/**
 * Site Controller
 */
class SiteController extends AreaAlunoController {

    public $helpers = array('Conteudos');

    public function initialize() {
        parent::initialize();
        $this->Alunos = $this->loadModel('Alunos');
        $this->Conteudos = $this->loadModel('Conteudos');
        $this->Quizzes = $this->loadModel('Quizzes');
        $this->AlunoRespostas = $this->loadModel('AlunoRespostas');
        $this->Perguntas = $this->loadModel('Perguntas');
        $this->Duvidas = $this->loadModel('Duvidas');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['nova_conta']);
    }

    private function _checkIsECACalculado() {
        $alunoId = $this->getIdUsuarioLogado();
        if (!$this->Alunos->ecaIsCalculado($alunoId)) {
            return $this->redirect(['action' => 'calcular_eca']);
        }
    }

    public function login() {
        $this->viewBuilder()->setLayout('login_aluno');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller' => 'site']);
            }

            $this->Flash->error('Login incorreto!');
        }
    }

    public function nova_conta() {
        $this->viewBuilder()->setLayout('login_aluno');
        $aluno = $this->Alunos->newEntity();
        if ($this->request->is('post')) {
            $aluno = $this->Alunos->patchEntity($aluno, $this->request->data);
            if ($this->Alunos->save($aluno)) {
                $this->Flash->success('Cadastro realizado com sucesso!');
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error('Ocorreu algum erro ao criar a conta!');
            }
        }
        $this->set(compact('aluno'));
        $this->set('_serialzie', ['aluno']);
    }

    public function logout() {
        $this->Flash->success('Você foi desconectado!');
        return $this->redirect($this->Auth->logout());
    }

    public function calcular_eca() {
        $this->viewBuilder()->setLayout('login_aluno');
        if ($this->request->is('post')) {
            try {
                list($eca, $eca_obs) = (new IdentificarECA())->indetificar($this->request->data);
                $this->Alunos->salvarECA($this->getIdUsuarioLogado(), $eca, $eca_obs);
                $this->Flash->success('Seu ECA é ' . AlunosTable::getNomeEca($eca));
                return $this->redirect(['action' => 'index']);
            } catch (Exception $e) {
                $this->Flash->error($e->getMessage());
            }
        }
    }

    public function index() {
        $this->_checkIsECACalculado();
        $this->set('conteudos', $this->Conteudos->getFullConteudos());
        $this->set('quizzes', $this->Quizzes->getQuizzesDisponiveis($this->getIdUsuarioLogado()));
        $this->set('duvidas', $this->Duvidas->getDuvidasCadastradas($this->getIdUsuarioLogado()));
    }

    public function conteudo() {
        $idConteudo = $this->request->query('id');
        $conteudo = $this->Conteudos->get($idConteudo, [
            'contain' => ['ConteudoPai']
        ]);
        $conteudo->nomeCompleto = '';
        if (!empty($conteudo->conteudo_pai)) {
            $conteudo->nomeCompleto .= $conteudo->conteudo_pai->nome . ' - ';
        }

        $conteudo->nomeCompleto .= $conteudo->nome;
        $this->set(compact('conteudo'));
    }

    public function download_doc($idConteudo) {
        $conteudo = $this->Conteudos->get($idConteudo);
        $file_path = WWW_ROOT . 'uploads/Conteudos/anexo_doc/' . $conteudo->pasta . '/' . $conteudo->anexo_doc;
        $this->response->file($file_path, array(
            'download' => true,
            'name' => $conteudo->anexo_doc,
        ));

        return $this->response;
    }

    public function proximo_conteudo($conteudoAtualId) {
        $this->Alunos->cadastraConteudoEstudado($conteudoAtualId, $this->getIdUsuarioLogado());
        $quizId = $this->Conteudos->conteudoTemQuiz($conteudoAtualId);
        if ($quizId) {
            return $this->redirect(['action' => 'quiz', $quizId, $conteudoAtualId]);
        }

        $this->irParaProximoConteudo($conteudoAtualId);
    }
    
    public function quiz_proximo_conteudo($conteudoAtualId) {
        $this->irParaProximoConteudo($conteudoAtualId);
    }

    private function irParaProximoConteudo($conteudoAtualId) {
        $conteudoAtual = $this->Conteudos->get($conteudoAtualId, [
            'contain' => ['ConteudoPai']
        ]);
        if (empty($conteudoAtual->conteudo_id)) { //significa que é um conteúdo pai
            $conteudosFilho = $this->Conteudos->getSubConteudos($conteudoAtual->id);
            if (empty($conteudosFilho)) {
                $this->Alunos->cadastraProximoConteudoPaiDisponivel($conteudoAtual->id, $this->getIdUsuarioLogado());
                $this->Flash->success('Parabéns, você finalizou o Conteúdo ' . $conteudoAtual->nome . '!');
                return $this->redirect(['action' => 'index']);
            }

            return $this->redirect([
                        'action' => 'conteudo',
                        '?' => ['id' => $conteudosFilho[0]->id]
            ]);
        }

        $conteudosFilho = $this->Conteudos->getSubConteudos($conteudoAtual->conteudo_id);
        $indexProximoConteudo = '';
        foreach ($conteudosFilho as $index => $conteudoFilho) {
            if ($conteudoFilho->id == $conteudoAtualId) {
                $indexProximoConteudo = $index + 1;
                if (!isset($conteudosFilho[$indexProximoConteudo])) {
                    $this->Alunos->cadastraProximoConteudoPaiDisponivel($conteudoAtual->conteudo_pai->id, $this->getIdUsuarioLogado());
                    $this->Flash->success('Parabéns, você finalizou o Conteúdo ' . $conteudoAtual->conteudo_pai->nome . '!');
                    return $this->redirect(['action' => 'index']);
                }

                return $this->redirect([
                            'action' => 'conteudo',
                            '?' => ['id' => $conteudosFilho[$indexProximoConteudo]->id]
                ]);
            }
        }
    }

    public function quiz($quizId, $conteudoAtualId = '') {
        if ($this->request->is('post')) {
            try {
                $conn = ConnectionManager::get('default');
                $conn->begin();
                $this->AlunoRespostas->salvarRespostasAluno($this->request->getData(), $this->getIdUsuarioLogado());
                $conn->commit();
                $this->Flash->success(__('Respostas salvas com sucesso!'));
                if (empty($conteudoAtualId)) {
                    return $this->redirect(['action' => 'index']);
                }

                $this->irParaProximoConteudo($conteudoAtualId);
            } catch (Exception $e) {
                $conn->rollback();
                $this->Flash->error($e->getMessage());
            }
        }

        $quizPerguntas = $this->Perguntas->getPerguntasERespostasAluno($quizId, $this->getIdUsuarioLogado());
        $this->set('quiz', $this->Quizzes->get($quizId));
        $this->set('quizPerguntas', $quizPerguntas);
    }

    public function cadastrar_duvida() {
        $duvida = $this->Duvidas->newEntity();
        if ($this->request->is('post')) {
            $duvida = $this->Duvidas->patchEntity($duvida, $this->request->getData());
            $duvida->aluno_id = $this->getIdUsuarioLogado();
            if ($this->Duvidas->save($duvida)) {
                $this->mandaEmailAvisandoProfessor($duvida);
                $this->Flash->success(__('The duvida has been saved.'));
                return $this->redirect(['action' => 'index#tm-section-3']);
            }

            $this->Flash->error(__('The duvida could not be saved. Please, try again.'));
        }

        $this->set(compact('duvida'));
        $this->set('_serialize', ['duvida']);
    }

    public function duvida($duvidaId) {
        $duvida = $this->Duvidas->get($duvidaId, [
            'contain' => ['Alunos']
        ]);

        $this->set('duvida', $duvida);
    }
    
    public function quiz_avaliado($quizId) {
        $quizAvaliado = $this->Perguntas->getQuizAvaliado($quizId, $this->getIdUsuarioLogado());
        $this->set('quizNome', $this->Quizzes->get($quizId)->nome);
        $this->set('quizPerguntas', $quizAvaliado);
    }

    private function mandaEmailAvisandoProfessor($duvida) {
        $email = new Email();
        $email->from(['williantcc2017@gmail.com' => 'Ambiente']);
        $email->to('willian.serafini@gmail.com');
        $email->setSubject('Nova Dúvida cadastrada');
        $msg = "Olá Professor, foi cadastrado uma nova dúvida no ambiente.\n"
                . "Por favor, acesse ....  \n\n";
        $msg .= "Assunto: " . $duvida->assunto . "\n";
        $msg .= "Mensagem: " . $duvida->mensagem;
        $email->send($msg);
    }

}
