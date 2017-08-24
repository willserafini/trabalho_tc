<?php
App::uses('AlunoSimulado', 'Model');

/**
 * AlunoSimulado Test Case
 *
 */
class AlunoSimuladoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.aluno_simulado',
		'app.aluno',
		'app.universidade',
		'app.municipio',
		'app.simulado'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AlunoSimulado = ClassRegistry::init('AlunoSimulado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AlunoSimulado);

		parent::tearDown();
	}

}
