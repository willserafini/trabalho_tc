<?php
App::uses('AlunoSimuladoResposta', 'Model');

/**
 * AlunoSimuladoResposta Test Case
 *
 */
class AlunoSimuladoRespostaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.aluno_simulado_resposta',
		'app.simulado',
		'app.universidade',
		'app.municipio',
		'app.aluno'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AlunoSimuladoResposta = ClassRegistry::init('AlunoSimuladoResposta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AlunoSimuladoResposta);

		parent::tearDown();
	}

}
