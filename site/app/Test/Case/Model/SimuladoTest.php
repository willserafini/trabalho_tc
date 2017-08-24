<?php
App::uses('Simulado', 'Model');

/**
 * Simulado Test Case
 *
 */
class SimuladoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.simulado',
		'app.universidade',
		'app.municipio',
		'app.gabarito'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Simulado = ClassRegistry::init('Simulado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Simulado);

		parent::tearDown();
	}

}
