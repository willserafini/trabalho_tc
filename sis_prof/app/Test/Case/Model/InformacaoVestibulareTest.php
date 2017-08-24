<?php
App::uses('InformacaoVestibulare', 'Model');

/**
 * InformacaoVestibulare Test Case
 *
 */
class InformacaoVestibulareTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.informacao_vestibulare'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InformacaoVestibulare = ClassRegistry::init('InformacaoVestibulare');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InformacaoVestibulare);

		parent::tearDown();
	}

}
