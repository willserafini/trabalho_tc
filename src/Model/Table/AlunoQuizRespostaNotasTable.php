<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AlunoQuizRespostaNotas Model
 *
 * @property \App\Model\Table\AlunoQuizzesTable|\Cake\ORM\Association\BelongsTo $AlunoQuizzes
 * @property \App\Model\Table\AlunoRespostasTable|\Cake\ORM\Association\BelongsTo $AlunoRespostas
 *
 * @method \App\Model\Entity\AlunoQuizRespostaNota get($primaryKey, $options = [])
 * @method \App\Model\Entity\AlunoQuizRespostaNota newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AlunoQuizRespostaNota[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AlunoQuizRespostaNota|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AlunoQuizRespostaNota patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AlunoQuizRespostaNota[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AlunoQuizRespostaNota findOrCreate($search, callable $callback = null, $options = [])
 */
class AlunoQuizRespostaNotasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('aluno_quiz_resposta_notas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('AlunoQuizzes', [
            'foreignKey' => 'aluno_quiz_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AlunoRespostas', [
            'foreignKey' => 'aluno_resposta_id',
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
                ->decimal('nota')
                ->requirePresence('nota', 'create')
                ->notEmpty('nota');

        $validator
                ->scalar('obs')
                ->allowEmpty('obs');

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
        $rules->add($rules->existsIn(['aluno_quiz_id'], 'AlunoQuizzes'));
        $rules->add($rules->existsIn(['aluno_resposta_id'], 'AlunoRespostas'));

        return $rules;
    }

}
