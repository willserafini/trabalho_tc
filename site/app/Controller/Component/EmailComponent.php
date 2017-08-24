<?php

App::uses('Component', 'Controller');

class EmailComponent extends Component {

    private $controller;
    private $objMail;
    private $Simulado;
    private $AlunoSimulado;
    private $AlunoSimuladoMateria;

    public function __construct(ComponentCollection $c) {
        App::import('Vendor', 'PHPMailer', array('file' => 'phpmailer' . DS . 'class.phpmailer.php'));
        $this->objMail = new PHPMailer();
        $this->Simulado = ClassRegistry::init('Simulado');
        $this->AlunoSimulado = ClassRegistry::init('AlunoSimulado');
        $this->AlunoSimuladoMateria = ClassRegistry::init('AlunoSimuladoMateria');
        $this->AlunoSimuladoMateria->recursive = -1;
        return parent::__construct($c);
    }

    public function startup(Controller $controller) {
        $this->controller = $controller;
    }

    public function SetSubject($assunto) {
        $this->objMail->Subject = $assunto;
    }

    public function SetFrom($email, $name = '') {
        $this->objMail->SetFrom($email, $name);
    }

    public function AddAddress($email, $name = '') {
        $this->objMail->AddAddress($email, $name);
    }

    public function AddReplyTo($email, $name = '') {
        $this->objMail->AddReplyTo($email, $name);
    }

    public function SetBody($body) {
        $this->objMail->Body = $body;
    }

    public function enviaEmailSimuladoNaoFeito($simulado, $dadosAluno) {
        $this->objMail->ClearAllRecipients();

        if (empty($dadosAluno['Aluno']['resp_email'])) {
            return;
        }

        $texto = Parametro::valor('TEXTO_EMAIL_SIMULADO_NAO_FEITO');
        $texto = str_replace('#nome_resp#', $dadosAluno['Aluno']['resp_nome'], $texto);
        $texto = str_replace('#nome_aluno#', $dadosAluno['Aluno']['nome'], $texto);
        $texto = str_replace('#lista#', $simulado, $texto);
        $this->SetBody($texto);
        $this->AddAddress($dadosAluno['Aluno']['resp_email']);
        $this->SetSubject('Lista Não Feita');
        $email = $this->_getEmailByEmpresa($dadosAluno['Aluno']['empresa_id']);
        $this->SetFrom($email, Parametro::valor('EMAIL_CONTATO_NOME'));
        $this->send();
    }

    private function _getEmailByEmpresa($empresaId) {
        $objEmpresa = ClassRegistry::init('Empresa');
        $objEmpresa->id = $empresaId;

        if (!empty($objEmpresa->field('email'))) {
            return $objEmpresa->field('email');
        }

        return Parametro::valor('EMAIL_CONTATO');
    }

    public function enviarEmailsListaFinalizada($simuladoId, $alunoId) {
        $this->enviaEmailSimuladoFinalizado($simuladoId, $alunoId, $toAluno = false);
        $this->enviaEmailSimuladoFinalizado($simuladoId, $alunoId);
    }

    private function enviaEmailSimuladoFinalizado($simuladoId, $alunoId, $toAluno = true) {
        $dadosAluno = ClassRegistry::init('Aluno')->findById($alunoId);
        if (($toAluno && empty($dadosAluno['Aluno']['email'])) ||
                (!$toAluno && empty($dadosAluno['Aluno']['resp_email']))) {
            return;
        }
        
        $this->objMail->ClearAllRecipients();
        $dadosSimulado = $this->Simulado->findById($simuladoId);
        $texto = Parametro::valor('TEXTO_EMAIL_SIMULADO_FINALIZADO_RESPONSAVEL');
        if ($toAluno) {
            $texto = Parametro::valor('TEXTO_EMAIL_SIMULADO_FINALIZADO_ALUNO');
        }

        $texto = str_replace('#nome_resp#', $dadosAluno['Aluno']['resp_nome'], $texto);
        $texto = str_replace('#lista#', $dadosSimulado['Simulado']['descricao'], $texto);
        $texto = str_replace('#nome_aluno#', $dadosAluno['Aluno']['nome'], $texto);

        $texto .= '<br /><br />';

        $texto .= $this->_getResultadosSimulado($simuladoId, $alunoId);
        $emailFrom = $this->_getEmailByEmpresa($dadosAluno['Aluno']['empresa_id']);
        $emailPara = $dadosAluno['Aluno']['resp_email'];
        if($toAluno) {
            $emailPara = $dadosAluno['Aluno']['email'];
        }
        
        $this->SetBody($texto);
        $this->AddAddress($emailPara);
        $this->SetSubject('Lista Finalizada');
        $this->SetFrom($emailFrom, Parametro::valor('EMAIL_CONTATO_NOME'));
        $this->send();
    }

    private function _getResultadosSimulado($simuladoId, $alunoId) {
        $alunoSimulado = $this->AlunoSimulado->findBySimuladoIdAndAlunoId($simuladoId, $alunoId);
        $materiasResultado = $this->AlunoSimuladoMateria->findAllByAlunoSimuladoId($alunoSimulado['AlunoSimulado']['id']);

        $html = '';
        if (!$this->Simulado->isSimuladoENEM($simuladoId)) {
            $html .= '<strong>NOTA TOTAL : ' . $alunoSimulado['AlunoSimulado']['media_final'] . '</strong><br />';
        }

        $html .= '<strong>TOTAL DE ACERTOS : ' . $alunoSimulado['AlunoSimulado']['numero_acertos'] . '</strong><br /><br />';
        $html .= '<table align="center" border="1" cellpadding="2" cellspacing="2" height="100%" width="100%">';
        $html .= '<tbody><tr>';
        $html .= '<th>DESEMPENHO POR MATÉRIA</th>';
        if (!$this->Simulado->isSimuladoENEM($simuladoId)) {
            $html .= '<th>NOTA</th>';
        }

        $html .= '<th>ACERTOS</th><th>TOTAL DE QUESTÕES</th></tr>';
        foreach ($materiasResultado as $materia) {
            $html .= '<tr align="center">';
            $html .= '<td>' . Materias::getNomeMateria($materia['AlunoSimuladoMateria']['materia']) . '</td>';
            if (!$this->Simulado->isSimuladoENEM($simuladoId)) {
                $html .= '<td>' . $materia['AlunoSimuladoMateria']['media'] . '</td>';
            }

            $html .= '<td>' . $this->Simulado->mostrarNumeroAcertos($materia['AlunoSimuladoMateria']['id'], $simuladoId, $alunoId) . '</td>';
            $html .= $this->Simulado->getTotalQuestoesMateria($simuladoId, $materia['AlunoSimuladoMateria']['materia']);
            $html .= '</tr>';
        }

        $html .= '</tbody></table><br />';
        if ($this->Simulado->simuladoTemRedacao($simuladoId)) {
            $html .= '<strong>NOTA REDAÇÃO : ' . $this->Simulado->getNotaRedacao($simuladoId, $alunoId) . '</strong>';
        }

        return $html;
    }

    public function send() {
        $this->objMail->IsSMTP();
        $this->objMail->SMTPAuth = true;
        $this->objMail->Host = Parametro::valor('SMTP_HOST');
        $this->objMail->Username = Parametro::valor('SMTP_USER');
        $this->objMail->Password = Parametro::valor('SMTP_PASSWORD');
        $this->objMail->Mailer = 'smtp';
        $this->objMail->CharSet = 'UTF-8';
        $this->objMail->Port = 587;
        $this->objMail->IsHTML(true);

        return $this->objMail->Send();
    }

}
