<?php
/**
 * GabaritoFixture
 *
 */
class GabaritoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'materia_simulado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'simulado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'materia' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => true),
		'num_questao' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => true),
		'alternativa_correta' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_gabaritos_simulados1_idx' => array('column' => 'simulado_id', 'unique' => 0),
			'fk_gabaritos_materia_simulados1_idx' => array('column' => 'materia_simulado_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'materia_simulado_id' => 1,
			'simulado_id' => 1,
			'materia' => 1,
			'num_questao' => 1,
			'alternativa_correta' => 'Lorem ipsum dolor sit ame'
		),
	);

}
