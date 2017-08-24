<?php
/**
 * AlunoSimuladoRespostaFixture
 *
 */
class AlunoSimuladoRespostaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'simulado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'aluno_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'materia' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => true),
		'numero_questao' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => true),
		'alternativa_selecionada' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_aluno_simulado_respostas_simulados1_idx' => array('column' => 'simulado_id', 'unique' => 0),
			'fk_aluno_simulado_respostas_alunos1_idx' => array('column' => 'aluno_id', 'unique' => 0)
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
			'simulado_id' => 1,
			'aluno_id' => 1,
			'materia' => 1,
			'numero_questao' => 1,
			'alternativa_selecionada' => 'Lorem ipsum dolor sit ame'
		),
	);

}
