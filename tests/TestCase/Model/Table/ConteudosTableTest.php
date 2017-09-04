<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConteudosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConteudosTable Test Case
 */
class ConteudosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConteudosTable
     */
    public $Conteudos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Conteudos') ? [] : ['className' => ConteudosTable::class];
        $this->Conteudos = TableRegistry::get('Conteudos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Conteudos);

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
