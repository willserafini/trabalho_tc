<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AlunoRespostasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AlunoRespostasTable Test Case
 */
class AlunoRespostasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AlunoRespostasTable
     */
    public $AlunoRespostas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.aluno_respostas',
        'app.alunos',
        'app.perguntas',
        'app.quizzes',
        'app.conteudos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AlunoRespostas') ? [] : ['className' => AlunoRespostasTable::class];
        $this->AlunoRespostas = TableRegistry::get('AlunoRespostas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AlunoRespostas);

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
