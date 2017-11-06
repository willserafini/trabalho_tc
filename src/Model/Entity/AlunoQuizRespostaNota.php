<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AlunoQuizRespostaNota Entity
 *
 * @property int $id
 * @property int $aluno_quiz_id
 * @property int $aluno_resposta_id
 * @property float $nota
 * @property string $obs
 *
 * @property \App\Model\Entity\AlunoQuiz $aluno_quiz
 * @property \App\Model\Entity\AlunoResposta $aluno_resposta
 */
class AlunoQuizRespostaNota extends Entity {

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
