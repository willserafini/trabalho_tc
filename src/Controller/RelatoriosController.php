<?php

namespace App\Controller;

use App\Controller\AreaProfessorController;
use Cake\Datasource\ConnectionManager;

/**
 * Relatorios Controller
 *
 *
 * @method \App\Model\Entity\Relatorio[] paginate($object = null, array $settings = [])
 */
class RelatoriosController extends AreaProfessorController {
    
    public function initialize() {
        parent::initialize();
        $this->Alunos = $this->loadModel('Alunos');
        $this->Conteudos = $this->loadModel('Conteudos');
        $this->Quizzes = $this->loadModel('Quizzes');
        $this->AlunoRespostas = $this->loadModel('AlunoRespostas');
        $this->Perguntas = $this->loadModel('Perguntas');
        $this->Duvidas = $this->loadModel('Duvidas');
    }

    public function index() {}

    public function avaliar_aluno_quiz() {
        if (isset($this->request->data['filtro'])) {
            $dados = $this->request->getData();
            $respostasAluno = $this->Quizzes->buscaDadosRespostasAluno($dados['aluno_id'], $dados['quiz_id']);
            $this->set('alunoId', $dados['aluno_id']);
            $this->set('quizId', $dados['quiz_id']);
            $this->set('respostasAluno', $respostasAluno);
        }

        if (isset($this->request->data['avaliar_aluno'])) {
            try {
                $conn = ConnectionManager::get('default');
                $conn->begin();
                $this->Quizzes->salvarNota($this->request->getData());
                $conn->commit();
                $this->Flash->success(__('Nota salva com sucesso!'));
                return $this->redirect(['action' => 'avaliar_aluno_quiz']);
            } catch (Exception $e) {
                $conn->rollback();
                $this->Flash->error($e->getMessage());
            }
        }

        $quizzes = $this->Quizzes->find('list')->contain(['Conteudos']);
        $this->set(compact('quizzes'));
    }

    public function desempenho_aluno_quizzes() {
        if ($this->request->is('post')) {
            $this->set('notasQuizzes', $this->Quizzes->getNotasQuizzesAluno($this->request->getData('aluno_id')));
        }

        $this->Alunos = $this->loadModel('Alunos');
        $this->set('alunos', $this->Alunos->find('list'));
    }

    public function acerto_erros_atividades() {
        if ($this->request->is('post')) {
            $dados = $this->request->getData();
            $quizAvaliado = $this->Quizzes->Perguntas->getQuizAvaliado($dados['quiz_id'], $dados['aluno_id']);
            if (!$quizAvaliado) {
                $this->Flash->error('Quiz ainda não foi avaliado!');
                return $this->redirect($this->referer());
            }

            $this->set('quizNome', $this->Quizzes->get($dados['quiz_id'])->nome);
            $this->set('quizPerguntas', $quizAvaliado);
        }

        $this->Alunos = $this->loadModel('Alunos');
        $quizzes = $this->Quizzes->find('list');
        $alunos = $this->Alunos->find('list');
        $this->set(compact('quizzes', 'alunos'));
    }

    public function getAlunosQueNaoForamAvaliadosAjax() {
        $this->viewBuilder()->setLayout('ajax');
        $quizId = $this->request->query['quizId'];
        echo json_encode($this->Quizzes->listAlunosQueNaoForamAvaliados($quizId));
        exit();
    }

}
