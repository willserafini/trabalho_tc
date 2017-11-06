<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlunoQuizRespostaNotasFixture
 *
 */
class AlunoQuizRespostaNotasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'aluno_quiz_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'aluno_resposta_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nota' => ['type' => 'decimal', 'length' => 4, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'obs' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_aluno_quiz_resposta_notas_aluno_quizzes1_idx' => ['type' => 'index', 'columns' => ['aluno_quiz_id'], 'length' => []],
            'fk_aluno_quiz_resposta_notas_aluno_respostas1_idx' => ['type' => 'index', 'columns' => ['aluno_resposta_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_aluno_quiz_resposta_notas_aluno_quizzes1' => ['type' => 'foreign', 'columns' => ['aluno_quiz_id'], 'references' => ['aluno_quizzes', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fk_aluno_quiz_resposta_notas_aluno_respostas1' => ['type' => 'foreign', 'columns' => ['aluno_resposta_id'], 'references' => ['aluno_respostas', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'aluno_quiz_id' => 1,
            'aluno_resposta_id' => 1,
            'nota' => 1.5,
            'obs' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
        ],
    ];
}
