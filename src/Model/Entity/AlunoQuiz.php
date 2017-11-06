<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AlunoQuiz Entity
 *
 * @property int $id
 * @property int $aluno_id
 * @property int $quiz_id
 * @property float $nota_final
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Aluno $aluno
 * @property \App\Model\Entity\Quiz $quiz
 * @property \App\Model\Entity\AlunoQuizRespostaNota[] $aluno_quiz_resposta_notas
 */
class AlunoQuiz extends Entity {

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
