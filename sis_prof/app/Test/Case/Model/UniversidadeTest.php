<?php
App::uses('Universidade', 'Model');

/**
 * Universidade Test Case
 *
 */
class UniversidadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.universidade',
		'app.municipio',
		'app.aluno',
		'app.simulado'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Universidade = ClassRegistry::init('Universidade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Universidade);

		parent::tearDown();
	}

}
