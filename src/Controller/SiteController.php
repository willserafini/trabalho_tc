<?php

namespace App\Controller;

use App\Controller\AreaAlunoController;

/**
 * Site Controller
 */

class SiteController extends AreaAlunoController {
    
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


    public function index() {
        
    }
    

}
