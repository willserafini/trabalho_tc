<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Alunos Model
 *
 * @method \App\Model\Entity\Aluno get($primaryKey, $options = [])
 * @method \App\Model\Entity\Aluno newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Aluno[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Aluno|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aluno patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Aluno[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Aluno findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AlunosTable extends Table {
    
    const CURSO_CIENCIA_COMPUTACAO = 1;
    const CURSO_ENGENHARIA_COMPUTACAO = 2;
    const CURSO_LITERATURA_COMPUTACAO = 3;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('alunos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
                ->scalar('nome')
                ->requirePresence('nome', 'create')
                ->notEmpty('nome');

        $validator
                ->email('email')
                ->requirePresence('email', 'create')
                ->notEmpty('email')
                ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
                ->scalar('senha')
                ->requirePresence('senha', 'create')
                ->notEmpty('senha');

        $validator
                ->date('data_nascimento')
                ->requirePresence('data_nascimento', 'create')
                ->notEmpty('data_nascimento');

        $validator
                ->integer('curso')
                ->requirePresence('curso', 'create')
                ->notEmpty('curso');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
    
    public static function getCursos() {
        return [
            self::CURSO_CIENCIA_COMPUTACAO => 'Ciência da Computação',
            self::CURSO_ENGENHARIA_COMPUTACAO => 'Engenharia da Computação',
            self::CURSO_LITERATURA_COMPUTACAO => 'Literatura da Computação'
        ];
    }
    
    public static function getNomeCurso($curso) {
        return self::getCursos()[$curso];
    }

}
