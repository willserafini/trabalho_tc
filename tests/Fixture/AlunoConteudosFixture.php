<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlunoConteudosFixture
 *
 */
class AlunoConteudosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'aluno_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'conteudo_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_aluno_conteudos_alunos1_idx' => ['type' => 'index', 'columns' => ['aluno_id'], 'length' => []],
            'fk_aluno_conteudos_conteudos1_idx' => ['type' => 'index', 'columns' => ['conteudo_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_aluno_conteudos_alunos1' => ['type' => 'foreign', 'columns' => ['aluno_id'], 'references' => ['alunos', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fk_aluno_conteudos_conteudos1' => ['type' => 'foreign', 'columns' => ['conteudo_id'], 'references' => ['conteudos', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'aluno_id' => 1,
            'conteudo_id' => 1
        ],
    ];
}
