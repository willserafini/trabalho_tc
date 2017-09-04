<?php

/**
 * Classe para identificar ECA Sequencial/Global
 *
 * @author Willian Serafini <willian.serafini@gmail.com>
 */

namespace App\Lib;

use App\Model\Table\AlunosTable;
use Cake\ORM\TableRegistry;

class IdentificarECA {

    /** Identifica eca Sequencial/Global e retorna um array com o tipo
     *  e dados adicionais do calculo
     * 
     * @param array $questoes
     * @return array
     */
    public function indetificar(array $questoes) {
        $ecasPontos = [
            AlunosTable::ECA_SEQUENCIAL => 0,
            AlunosTable::ECA_GLOBAL => 0
        ];
        
        //somatorio dos pontos para cada ECA
        foreach ($questoes as $questao) {
            if ($questao == '0') {
                $ecasPontos[AlunosTable::ECA_SEQUENCIAL] ++;
            } else {
                $ecasPontos[AlunosTable::ECA_GLOBAL] ++;
            }
        }

        $eca = AlunosTable::ECA_SEQUENCIAL;
        if ($ecasPontos[AlunosTable::ECA_GLOBAL] > $ecasPontos[AlunosTable::ECA_SEQUENCIAL]) {
            $eca = AlunosTable::ECA_GLOBAL;
        }

        $resultadoSubtracao = abs($ecasPontos[AlunosTable::ECA_SEQUENCIAL] - $ecasPontos[AlunosTable::ECA_GLOBAL]);

        $ecaObs = [
            'respostas_selecionadas' => $questoes,
            'resultado_sub' => $resultadoSubtracao
        ];

        return array($eca, json_encode($ecaObs));
    }

}
