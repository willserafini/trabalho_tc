<?php
/**
 * AlunoSimuladoFixture
 *
 */
class AlunoSimuladoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'aluno_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'simulado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'data_conclusao' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'media_final' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '10,4', 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_aluno_simulados_alunos1_idx' => array('column' => 'aluno_id', 'unique' => 0),
			'fk_aluno_simulados_simulados1_idx' => array('column' => 'simulado_id', 'unique' => 0)
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
			'aluno_id' => 1,
			'simulado_id' => 1,
			'data_conclusao' => '2015-05-19 21:17:28',
			'media_final' => ''
		),
	);

}
