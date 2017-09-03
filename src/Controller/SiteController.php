<?php

namespace App\Controller;

use App\Controller\AreaAlunoController;
use Cake\Event\Event;
use App\Model\Entity\Aluno;
use App\Model\Table\AlunosTable;

/**
 * Site Controller
 */
class SiteController extends AreaAlunoController {

    private function _checkIsECACalculado() {
        $alunoId = $this->getIdUsuarioLogado();
        $Aluno = $this->loadModel('Alunos');
        if (!$Aluno->ecaIsCalculado($alunoId)) {
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

    public function logout() {
        $this->Flash->success('Você foi desconectado!');
        return $this->redirect($this->Auth->logout());
    }

    public function calcular_eca() {
        //debug('oioi');exit;
    }

    public function index() {
        $this->_checkIsECACalculado();
    }

}
