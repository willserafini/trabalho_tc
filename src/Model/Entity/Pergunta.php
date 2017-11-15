<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pergunta Entity
 *
 * @property int $id
 * @property int $quiz_id
 * @property int $tipo
 * @property int $num_questao
 * @property string $questao
 * @property string $opcoes_resposta_objetiva
 * @property string $resposta_correta
 *
 * @property \App\Model\Entity\Quiz $quiz
 */
class Pergunta extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

}
