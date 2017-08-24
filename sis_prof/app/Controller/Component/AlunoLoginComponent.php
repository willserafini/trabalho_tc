<?php

class AlunoLoginComponent extends Component {

    public $controller;
    public $Session;
    private $loginUrl = ['controller' => 'site', 'action' => 'login'];

    public function startup(Controller $controller) {

        $this->controller = $controller;
        App::uses('SessionComponent', 'Controller/Component');
        $this->Session = new SessionComponent(new ComponentCollection());
        $this->Session->startup(new Controller());

        App::uses('Aluno', 'Model');
        $this->Aluno = ClassRegistry::init('Aluno');
    }

    public function isLogado() {
        return $this->Session->check('Aluno');
    }

    public function logout() {
        $this->Session->delete('redirect');
        return $this->Session->delete('Aluno');
    }

    public function logar($aluno) { 
        $dados = [
            'id' => $aluno[$this->Aluno->alias]['id'],
            'isResponsavel' => false
        ];
        if(isset($aluno[$this->Aluno->alias]['isResponsavel'])) {
            $dados['isResponsavel'] = true;
        }
        
        return $this->Session->write('Aluno', $dados);
    }

    public function checaLogado($url = null) {
        if (!$this->isLogado()) {
            if (!empty($url)) {
                $this->Session->write('redirect', $url);
            }

            $this->controller->redirect($this->loginUrl);
            exit();
        }
    }

    public function loginPeloSite($matricula, $senha) {
        $aluno = $this->Aluno->alunoValido($matricula, $senha);
        $this->logar($aluno);
        return $aluno;
    }
    
    public function getIdAluno(){
        return $this->Session->read('Aluno.id');
    }

    public function getDadosAluno(){
        $aluno_id = $this->getIdAluno();
        $this->Aluno->recursive = -1;
        return $this->Aluno->findById($aluno_id);
    }
    
    public function getLinguaEstrangeira() {
        $aluno = $this->getDadosAluno();
        return $aluno['Aluno']['lingua_estrangeira'];
    }
    
    public function getNomeAluno() {
        $aluno = $this->getDadosAluno();
        return $aluno['Aluno']['nome'];
    }
    
    public function isResponsavel() {
        return $this->Session->read('Aluno.isResponsavel');
    }

}