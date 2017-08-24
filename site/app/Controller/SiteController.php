<?php

//App::import('Model', 'Simulado');

class SiteController extends AppController {

    public $uses = array();
    public $layout = 'default';
    public $components = array('AlunoLogin', 'Session', 'Email');

    public function beforeFilter() {
        $this->Main->allow('*');
        return parent::beforeFilter();
    }

    public function login() {
        if ($this->AlunoLogin->isLogado()) {
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->request->data)) {
            try {
                $this->AlunoLogin->loginPeloSite($this->request->data['Aluno']['matricula'], $this->request->data['Aluno']['senha']);
                $this->redirect(array('action' => 'index'));
            } catch (Exception $e) {
                $this->Session->setFlash($e->getMessage());
            }
        }
    }

    public function logout() {
        $this->AlunoLogin->logout();
        $this->redirect('/');
    }

}
