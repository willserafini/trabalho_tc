<?php
App::uses('MateriaSimuladoPergunta', 'Model');

/**
 * MateriaSimuladoPergunta Test Case
 *
 */
class MateriaSimuladoPerguntaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.materia_simulado_pergunta',
		'app.materia_simulado',
		'app.simulado',
		'app.universidade',
		'app.municipio',
		'app.empresa'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MateriaSimuladoPergunta = ClassRegistry::init('MateriaSimuladoPergunta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MateriaSimuladoPergunta);

		parent::tearDown();
	}

}
