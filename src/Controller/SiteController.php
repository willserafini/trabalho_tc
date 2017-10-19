<?php

namespace App\Controller;

use App\Controller\AreaAlunoController;
use Cake\Event\Event;
use App\Lib\IdentificarECA;
use App\Model\Table\AlunosTable;

/**
 * Site Controller
 */
class SiteController extends AreaAlunoController {
    
    public $helpers = array('Conteudos');

    public function initialize() {
        parent::initialize();
        $this->Alunos = $this->loadModel('Alunos');        
        $this->Conteudos = $this->loadModel('Conteudos');
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
        if ($this->request->is('post')) {
            try {
                list($eca, $eca_obs) = (new IdentificarECA())->indetificar($this->request->data);
                $this->Alunos->salvarECA($this->getIdUsuarioLogado(), $eca, $eca_obs);
                $this->Flash->success('Seu ECA é ' . AlunosTable::getNomeEca($eca));
                return $this->redirect(['action' => 'index']);
            } catch (Exception $ex) {
                $this->Flash->error($e->getMessage());
            }
        }
    }

    public function index() {
        $this->_checkIsECACalculado();
        $this->set('conteudos', $this->Conteudos->getFullConteudos());
        //debug($conteudos);exit;
    }

}
