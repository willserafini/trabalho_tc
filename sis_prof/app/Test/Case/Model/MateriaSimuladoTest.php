<?php
App::uses('MateriaSimulado', 'Model');

/**
 * MateriaSimulado Test Case
 *
 */
class MateriaSimuladoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.materia_simulado',
		'app.simulado',
		'app.universidade',
		'app.municipio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MateriaSimulado = ClassRegistry::init('MateriaSimulado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MateriaSimulado);

		parent::tearDown();
	}

}
