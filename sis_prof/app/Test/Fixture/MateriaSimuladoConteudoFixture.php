<?php
/**
 * MateriaSimuladoConteudoFixture
 *
 */
class MateriaSimuladoConteudoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'materia_simulado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'conteudo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'num_questao' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_materia_simulado_conteudos_materia_simulados1_idx' => array('column' => 'materia_simulado_id', 'unique' => 0),
			'fk_materia_simulado_conteudos_conteudos1_idx' => array('column' => 'conteudo_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB')
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
			'conteudo_id' => 1,
			'num_questao' => 1
		),
	);

}
