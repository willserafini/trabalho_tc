<?php
App::uses('MateriaSimuladoConteudo', 'Model');

/**
 * MateriaSimuladoConteudo Test Case
 *
 */
class MateriaSimuladoConteudoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.materia_simulado_conteudo',
		'app.materia_simulado',
		'app.simulado',
		'app.universidade',
		'app.municipio',
		'app.empresa',
		'app.conteudo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MateriaSimuladoConteudo = ClassRegistry::init('MateriaSimuladoConteudo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MateriaSimuladoConteudo);

		parent::tearDown();
	}

}
