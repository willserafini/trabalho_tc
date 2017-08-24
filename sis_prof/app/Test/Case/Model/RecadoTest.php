<?php
App::uses('Recado', 'Model');

/**
 * Recado Test Case
 *
 */
class RecadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recado',
		'app.empresa'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Recado = ClassRegistry::init('Recado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Recado);

		parent::tearDown();
	}

}
