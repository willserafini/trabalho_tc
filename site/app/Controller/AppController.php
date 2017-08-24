<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {
    public $components = array('RequestHandler', 'Session', 'Paginator', 'Email');
    public $helpers = array('Session', 'Html', 'Form', 'Time', 'Paginator');
    public $layout = 'default';    
    
    protected function _isRoot() {
        return $this->Session->read('OwCore.UsuarioGrupo.root') == true;
    }
    
    protected function getDadosUsuario() {
        return $this->Session->read('Usuario');
    }
    
    protected function getIdEmpresaUsuario() {
        $dados = $this->getDadosUsuario();
        return $dados['empresa_id'];
    }
}