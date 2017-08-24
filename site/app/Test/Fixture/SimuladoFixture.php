<?php
/**
 * SimuladoFixture
 *
 */
class SimuladoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'universidade_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'descricao' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'data_inicio' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'data_fim' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_simulados_universidades1_idx' => array('column' => 'universidade_id', 'unique' => 0)
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
			'universidade_id' => 1,
			'descricao' => 'Lorem ipsum dolor sit amet',
			'data_inicio' => '2015-03-24 18:56:57',
			'data_fim' => '2015-03-24 18:56:57'
		),
	);

}
