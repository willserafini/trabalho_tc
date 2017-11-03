<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Conteudos Model
 *
 * @property \App\Model\Table\ConteudosTable|\Cake\ORM\Association\BelongsTo $Conteudos
 * @property \App\Model\Table\ConteudosTable|\Cake\ORM\Association\HasMany $Conteudos
 *
 * @method \App\Model\Entity\Conteudo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Conteudo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Conteudo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Conteudo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Conteudo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Conteudo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Conteudo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConteudosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('conteudos');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ConteudoPai', [
            'className' => 'Conteudos',
            'foreignKey' => 'conteudo_id'
        ]);
        $this->belongsTo('ConteudoAnterior', [
            'className' => 'Conteudos',
            'foreignKey' => 'conteudo_anterior_id'
        ]);
        $this->hasMany('ConteudoFilho', [
            'className' => 'Conteudos',
            'foreignKey' => 'conteudo_id',
            'sort' => ['ConteudoFilho.ordem' => 'ASC']
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'anexo_img' => [
                'path' => 'webroot/uploads{DS}{model}{DS}{field}{DS}{field-value:pasta}'
            ],
            'anexo_doc' => [
                'path' => 'webroot/uploads{DS}{model}{DS}{field}{DS}{field-value:pasta}'
            ]
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
                ->scalar('nome')
                ->requirePresence('nome', 'create')
                ->notEmpty('nome');

        $validator
                ->scalar('descricao')
                ->allowEmpty('descricao');

        $validator
                ->allowEmpty('anexo_img');

        $validator
                ->allowEmpty('anexo_doc');

        $validator
                ->scalar('pasta')
                ->requirePresence('pasta', 'create')
                ->allowEmpty('pasta');

        $validator
                ->scalar('explicacao_geral')
                ->allowEmpty('explicacao_geral');

        $validator
                ->integer('ordem')
                ->allowEmpty('ordem');

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
        return $rules;
    }

    public function listConteudosPrincipais() {
        $this->recursive = -1;
        return $this->find('list', ['conditions' => ['Conteudos.conteudo_id IS NULL'], 'order' => 'Conteudos.ordem ASC']);
    }

    private function getConteudosPrincipais() {
        $this->recursive = -1;
        $query = $this->find('all', ['conditions' => ['Conteudos.conteudo_id IS NULL'], 'order' => 'Conteudos.ordem ASC']);
        $conteudos = $query->all();
        return $conteudos->toArray();
    }

    /**
     * 
     * @return array com Conteudos Pais e seus respectivos conteudos filhos
     */
    public function getFullConteudos() {
        $conteudosPai = $this->getConteudosPrincipais();

        foreach ($conteudosPai as &$conteudo) {
            $subConteudos = $this->getSubConteudos($conteudo->id);
            if (!count($subConteudos)) {
                continue;
            }

            $conteudo['SubConteudos'] = $subConteudos;
        }

        return $conteudosPai;
    }

    /**
     * 
     * @param int $conteudo_id
     * @return array com conteudos filhos
     */
    public function getSubConteudos($conteudo_id) {
        $this->recursive = -1; //verificar
        $query = $this->find('all', ['conditions' => ['Conteudos.conteudo_id' => $conteudo_id], 'order' => 'Conteudos.ordem ASC']);

        $subs = $query->all();

        $subsArray = $subs->toArray();
        /* foreach ($subsArray as &$sub) {
          $subConteudo = $this->getSubMenus($sub->id);
          if (!count($subConteudo)) {
          continue;
          }

          $sub['SubConteudos'] = $subConteudo;
          } */

        return $subsArray;
    }
    
    public function listSubConteudos($conteudo_id) {
        $this->recursive = -1;
        return $this->find('list', ['conditions' => ['Conteudos.conteudo_id' => $conteudo_id], 'order' => 'Conteudos.ordem ASC']);
    }

    public static function getPastaConteudos() {
        return date('m/d');
    }

    /**
     * 
     * @param int $conteudoId
     * @return false se nao tem quiz, se tiver retorna o id do quiz
     */
    public function conteudoTemQuiz($conteudoId) {
        $ModelQuizzes = TableRegistry::get('Quizzes');
        $quiz = $ModelQuizzes->find('all', ['conditions' => [ 'Quizzes.conteudo_id' => $conteudoId]])->first();
        if (empty($quiz)) {
            return false;
        }
        
        return $quiz->id;
    }

}
