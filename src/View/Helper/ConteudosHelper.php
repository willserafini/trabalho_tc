<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\HtmlHelper;

/**
 * Conteudos helper
 */
class ConteudosHelper extends Helper {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $helpers = array('Url');

    public function imprimiConteudosHTML() {
        $this->Conteudos = TableRegistry::get('Conteudos');
        $this->AlunoConteudos = TableRegistry::get('AlunoConteudos');
        $dadosAluno = $this->request->session()->read('Auth')['Aluno'];

        $conteudos = $this->Conteudos->getFullConteudos();
        $conteudosQueAlunoEstudou = $this->AlunoConteudos->getConteudosQueAlunoEstudou($dadosAluno['id']);
        $html = '<ul class="sf-menu">';
        foreach ($conteudos as $index => $conteudo) {
            $strLink = $conteudo->nome;
            if (isset($conteudosQueAlunoEstudou[$conteudo->id])) {
                $strLink = '<a href="' . $this->Url->build('/site/conteudo?id=' . $conteudo->id) . '">' . $conteudo->nome . '</a>';
            }
            
            $html .= '<li>';
            $html .= $strLink;
            $html .= $this->getHtmlSubMenus($conteudo, 1, $conteudosQueAlunoEstudou);
            $html .= '</li>';
        }
        $html .= '</ul>';

        return $html;
    }

    private function getHtmlSubMenus(&$conteudo, $nivel, $conteudosQueAlunoEstudou) {
        if (!isset($conteudo['SubConteudos'])) {
            return '';
        }

        $html = '<ul class="nivel_' . $nivel . '">';
        foreach ($conteudo['SubConteudos'] as $m) {
            $strLink = $m->nome;
            if (isset($conteudosQueAlunoEstudou[$m->id])) {
                $strLink = '<a href="' . $this->Url->build('/site/conteudo?id=' . $m->id) . '">' . $m->nome . '</a>';
            }
            
            $html .= '<li>';
            $html .= $strLink;
            //$html .= $this->getHtmlSubMenus($m, ($nivel + 1));
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

}
