<?php
App::uses('Gabarito', 'Model');

/**
 * Gabarito Test Case
 *
 */
class GabaritoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gabarito',
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
		$this->Gabarito = ClassRegistry::init('Gabarito');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Gabarito);

		parent::tearDown();
	}

}
