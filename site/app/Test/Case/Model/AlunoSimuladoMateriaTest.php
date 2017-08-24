<?php
App::uses('AlunoSimuladoMateria', 'Model');

/**
 * AlunoSimuladoMateria Test Case
 *
 */
class AlunoSimuladoMateriaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.aluno_simulado_materia',
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
		$this->AlunoSimuladoMateria = ClassRegistry::init('AlunoSimuladoMateria');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AlunoSimuladoMateria);

		parent::tearDown();
	}

}
