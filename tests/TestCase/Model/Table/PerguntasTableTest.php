<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PerguntasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PerguntasTable Test Case
 */
class PerguntasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PerguntasTable
     */
    public $Perguntas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Perguntas') ? [] : ['className' => PerguntasTable::class];
        $this->Perguntas = TableRegistry::get('Perguntas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Perguntas);

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
