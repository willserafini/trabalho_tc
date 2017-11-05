<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Duvidas Model
 *
 * @property \App\Model\Table\AlunosTable|\Cake\ORM\Association\BelongsTo $Alunos
 *
 * @method \App\Model\Entity\Duvida get($primaryKey, $options = [])
 * @method \App\Model\Entity\Duvida newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Duvida[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Duvida|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Duvida patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Duvida[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Duvida findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DuvidasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('duvidas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Alunos', [
            'foreignKey' => 'aluno_id',
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

        $validator
                ->scalar('assunto')
                ->requirePresence('assunto', 'create')
                ->notEmpty('assunto');

        $validator
                ->scalar('mensagem')
                ->requirePresence('mensagem', 'create')
                ->notEmpty('mensagem');

        $validator
                ->scalar('feedback_professor')
                ->allowEmpty('feedback_professor');

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

        return $rules;
    }
    
    public function getDuvidasCadastradas($alunoId) {
        return $this->find('all')->where(['Duvidas.aluno_id' => $alunoId]);
    }

}
