<?php
App::uses('Conteudo', 'Model');

/**
 * Conteudo Test Case
 *
 */
class ConteudoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.conteudo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Conteudo = ClassRegistry::init('Conteudo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Conteudo);

		parent::tearDown();
	}

}
