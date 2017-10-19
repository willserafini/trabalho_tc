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
        $conteudos = $this->Conteudos->getFullConteudos();

        $html = '<ul class="sf-menu">';
        foreach ($conteudos as $conteudo) {
            $html .= '<li>';
            $html .= '<a href="#">' . $conteudo->nome . '</a>';
            $html .= $this->getHtmlSubMenus($conteudo, 1);
            $html .= '</li>';
        }
        $html .= '</ul>';

        return $html;
    }

    private function getHtmlSubMenus(&$conteudo, $nivel) {
        if (!isset($conteudo['SubConteudos'])) {
            return '';
        }

        $html = '<ul class="nivel_' . $nivel . '">';
        foreach ($conteudo['SubConteudos'] as $m) {
            $html .= '<li>';
            $html .= '<a href="' . $this->Url->build('/site/conteudo?id=' . $m->id) . '">' . $m->nome . '</a>';
            //$html .= $this->getHtmlSubMenus($m, ($nivel + 1));
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

}
