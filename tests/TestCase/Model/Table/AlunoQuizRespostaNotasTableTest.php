<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AlunoQuizRespostaNotasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AlunoQuizRespostaNotasTable Test Case
 */
class AlunoQuizRespostaNotasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AlunoQuizRespostaNotasTable
     */
    public $AlunoQuizRespostaNotas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.aluno_quiz_resposta_notas',
        'app.aluno_quizzes',
        'app.alunos',
        'app.quizzes',
        'app.conteudos',
        'app.perguntas',
        'app.aluno_respostas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AlunoQuizRespostaNotas') ? [] : ['className' => AlunoQuizRespostaNotasTable::class];
        $this->AlunoQuizRespostaNotas = TableRegistry::get('AlunoQuizRespostaNotas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AlunoQuizRespostaNotas);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
