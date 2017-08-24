<?php
/**
 * AlunoSimuladoMateriaFixture
 *
 */
class AlunoSimuladoMateriaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'aluno_simulado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'materia' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => false),
		'media' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '10,8', 'unsigned' => false),
		'numero_acertos' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_aluno_simulado_materias_aluno_simulados1_idx' => array('column' => 'aluno_simulado_id', 'unique' => 0)
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
			'aluno_simulado_id' => 1,
			'materia' => 1,
			'media' => '',
			'numero_acertos' => 1
		),
	);

}
