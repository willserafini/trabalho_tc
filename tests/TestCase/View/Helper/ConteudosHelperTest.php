<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ConteudosHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ConteudosHelper Test Case
 */
class ConteudosHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\ConteudosHelper
     */
    public $Conteudos;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Conteudos = new ConteudosHelper($view);
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
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
