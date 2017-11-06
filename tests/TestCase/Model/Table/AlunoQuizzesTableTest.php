<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AlunoQuizzesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AlunoQuizzesTable Test Case
 */
class AlunoQuizzesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AlunoQuizzesTable
     */
    public $AlunoQuizzes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.aluno_quizzes',
        'app.alunos',
        'app.quizzes',
        'app.conteudos',
        'app.perguntas',
        'app.aluno_quiz_resposta_notas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AlunoQuizzes') ? [] : ['className' => AlunoQuizzesTable::class];
        $this->AlunoQuizzes = TableRegistry::get('AlunoQuizzes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AlunoQuizzes);

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
