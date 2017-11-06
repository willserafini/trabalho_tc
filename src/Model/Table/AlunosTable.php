<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

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
    const ECA_SEQUENCIAL = 1;
    const ECA_GLOBAL = 2;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('alunos');
        $this->setDisplayField('nome');
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

    public function ecaIsCalculado($id) {
        $aluno = $this->get($id);
        return !empty($aluno->eca_compreensao);
    }

    public function salvarECA($alunoId, $eca_compreensao, $eca_obs) {
        $aluno = $this->get($alunoId);

        $aluno->eca_compreensao = $eca_compreensao;
        $aluno->eca_obs = $eca_obs;
        if (!$this->save($aluno)) {
            throw new Exception('Não foi possível salvar o ECA!');
        }

        if ($eca_compreensao == self::ECA_SEQUENCIAL) {
            $this->salvaPrimeiroConteudoParaAluno($alunoId);
        }
    }

    private function salvaPrimeiroConteudoParaAluno($alunoId) {
        $this->Conteudos = TableRegistry::get('Conteudos');
        $primeiroConteudoDisponivel = $this->Conteudos->getPrimeiroConteudo();
        $this->cadastraConteudoEstudado($primeiroConteudoDisponivel->id, $alunoId);
    }

    public function cadastraConteudoEstudado($conteudoId, $alunoId) {
        $modelAlunoConteudos = TableRegistry::get('AlunoConteudos');
        $query = $modelAlunoConteudos->find('all', [
            'conditions' => [
                'AlunoConteudos.conteudo_id' => $conteudoId,
                'AlunoConteudos.aluno_id' => $alunoId
            ],
        ]);
        $alunoEstudouConteudo = $query->first();
        if (!empty($alunoEstudouConteudo)) {
            return;
        }

        $objAlunoConteudos = $modelAlunoConteudos->newEntity();
        $objAlunoConteudos->aluno_id = $alunoId;
        $objAlunoConteudos->conteudo_id = $conteudoId;
        if (!$modelAlunoConteudos->save($objAlunoConteudos)) {
            throw new Exception('Não foi possível salvar o conteúdo para o aluno!');
        }
    }
    
    public function cadastraProximoConteudoPaiDisponivel($conteudoPaiId, $alunoId) {
        $modelConteudos = TableRegistry::get('Conteudos');
        $conteudosPai = $modelConteudos->getFullConteudos(true);
        $indexProximoConteudoPaiDisponivel = '';
        foreach ($conteudosPai as $index => $conteudoPai) {
            if($conteudoPaiId == $conteudoPai->id) {
                $indexProximoConteudoPaiDisponivel = $index + 1;
                break;
            }
        }
        
        if(!isset($conteudosPai[$indexProximoConteudoPaiDisponivel])) {
            return;
        }
        
        $this->cadastraConteudoEstudado($conteudosPai[$indexProximoConteudoPaiDisponivel]->id, $alunoId);
    }
    
    public function getEcaAluno($alunoId) {
        $aluno = $this->get($alunoId);
        return $aluno->eca_compreensao;
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

    public static function getEcas() {
        return [
            self::ECA_SEQUENCIAL => 'Sequencial',
            self::ECA_GLOBAL => 'Global'
        ];
    }

    public static function getNomeEca($eca) {
        $ecas = self::getEcas();
        if (!isset($ecas[$eca])) {
            return '';
        }

        return $ecas[$eca];
    }

}
