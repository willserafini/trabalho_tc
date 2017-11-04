<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Quizzes Model
 *
 * @property \App\Model\Table\ConteudosTable|\Cake\ORM\Association\BelongsTo $Conteudos
 * @property \App\Model\Table\PerguntasTable|\Cake\ORM\Association\HasMany $Perguntas
 *
 * @method \App\Model\Entity\Quiz get($primaryKey, $options = [])
 * @method \App\Model\Entity\Quiz newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Quiz[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Quiz|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Quiz patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Quiz[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Quiz findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuizzesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('quizzes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Conteudos', [
            'foreignKey' => 'conteudo_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Perguntas', [
            'foreignKey' => 'quiz_id'
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
        $rules->add($rules->existsIn(['conteudo_id'], 'Conteudos'));

        return $rules;
    }

    public function salvar($dados) {
        $quiz = $this->newEntity($dados);
        if (!$this->save($quiz)) {
            throw new Exception('Não foi possível salvar o quiz!');
        }
    }
    
    public function getQuizzesDisponiveis($alunoId) {
        $quizzes = $this->find('all')->contain(['Conteudos']);
        $quizzesDisponiveis = [];
        foreach ($quizzes as $quiz) {
            if($this->alunoJaEstudouConteudo($alunoId, $quiz->conteudo_id)) {
                $quizzesDisponiveis[] = $quiz;
            }
        }
        
        return $quizzesDisponiveis;
    }
    
    private function alunoJaEstudouConteudo($alunoId, $conteudoId) {
        $modelAlunoConteudos = TableRegistry::get('AlunoConteudos');
        $query = $modelAlunoConteudos->find('all', [
            'conditions' => [
                'AlunoConteudos.conteudo_id' => $conteudoId,
                'AlunoConteudos.aluno_id' => $alunoId
            ],
        ]);
        $alunoEstudouConteudo = $query->first();
        if (!empty($alunoEstudouConteudo)) {
            return true;
        }
        
        return false;
    }

}
