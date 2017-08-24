<?php
App::uses('MateriaSimuladoResposta', 'Model');

/**
 * MateriaSimuladoResposta Test Case
 *
 */
class MateriaSimuladoRespostaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.materia_simulado_resposta',
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
		$this->MateriaSimuladoResposta = ClassRegistry::init('MateriaSimuladoResposta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MateriaSimuladoResposta);

		parent::tearDown();
	}

}
