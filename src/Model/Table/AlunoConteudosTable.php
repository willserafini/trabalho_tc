<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AlunoConteudos Model
 *
 * @property \App\Model\Table\AlunosTable|\Cake\ORM\Association\BelongsTo $Alunos
 * @property \App\Model\Table\ConteudosTable|\Cake\ORM\Association\BelongsTo $Conteudos
 *
 * @method \App\Model\Entity\AlunoConteudo get($primaryKey, $options = [])
 * @method \App\Model\Entity\AlunoConteudo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AlunoConteudo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AlunoConteudo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AlunoConteudo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AlunoConteudo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AlunoConteudo findOrCreate($search, callable $callback = null, $options = [])
 */
class AlunoConteudosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('aluno_conteudos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Alunos', [
            'foreignKey' => 'aluno_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Conteudos', [
            'foreignKey' => 'conteudo_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['aluno_id'], 'Alunos'));
        $rules->add($rules->existsIn(['conteudo_id'], 'Conteudos'));

        return $rules;
    }

    public function getConteudosQueAlunoEstudou($alunoId) {
        $alunoConteudos = $this->find('all', ['conditions' => ['AlunoConteudos.aluno_id' => $alunoId]])->all()->toArray();
        $conteudosQueAlunoEstudou = [];
        foreach ($alunoConteudos as $contAluno) {
            $idConteudo = $contAluno->conteudo_id;
            $conteudosQueAlunoEstudou[$idConteudo] = true;
        }
        
        return $conteudosQueAlunoEstudou;
    }

}
