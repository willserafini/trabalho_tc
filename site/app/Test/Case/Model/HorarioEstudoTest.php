<?php
App::uses('HorarioEstudo', 'Model');

/**
 * HorarioEstudo Test Case
 *
 */
class HorarioEstudoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.horario_estudo',
		'app.aluno',
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
		$this->HorarioEstudo = ClassRegistry::init('HorarioEstudo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HorarioEstudo);

		parent::tearDown();
	}

}
