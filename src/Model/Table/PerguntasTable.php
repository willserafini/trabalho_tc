<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Perguntas Model
 *
 * @property \App\Model\Table\QuizzesTable|\Cake\ORM\Association\BelongsTo $Quizzes
 *
 * @method \App\Model\Entity\Pergunta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pergunta newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pergunta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pergunta|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pergunta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pergunta[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pergunta findOrCreate($search, callable $callback = null, $options = [])
 */
class PerguntasTable extends Table {

    const TIPO_DISSERTATIVA = 1;
    const TIPO_OBJETIVA = 2;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('perguntas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Quizzes', [
            'foreignKey' => 'quiz_id',
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
                ->integer('tipo')
                ->requirePresence('tipo', 'create')
                ->notEmpty('tipo');

        $validator
                ->integer('num_questao')
                ->requirePresence('num_questao', 'create')
                ->notEmpty('num_questao');

        $validator
                ->scalar('questao')
                ->requirePresence('questao', 'create')
                ->notEmpty('questao');

        $validator
                ->scalar('opcoes_resposta_objetiva')
                ->allowEmpty('opcoes_resposta_objetiva');

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
        $rules->add($rules->existsIn(['quiz_id'], 'Quizzes'));

        return $rules;
    }

    public function getPerguntasERespostasAluno($quizId, $alunoId) {
        $ModelAlunoRespostas = TableRegistry::get('AlunoRespostas');
        $this->recursive = -1;
        $queryPerguntas = $this->find('all', ['conditions' => ['Perguntas.quiz_id' => $quizId]])->all()->toArray();

        foreach ($queryPerguntas as &$pergunta) {
            $options = [
                'conditions' => [
                    'AlunoRespostas.aluno_id' => $alunoId,
                    'AlunoRespostas.quiz_id' => $quizId,
                    'AlunoRespostas.pergunta_id' => $pergunta->id
                ]
            ];
            $respostaDoAluno = $ModelAlunoRespostas->find('all', $options)->first();
            $pergunta->respostaAluno = $pergunta->aluno_resposta_id = '';
            if (!empty($respostaDoAluno)) {
                $pergunta->respostaAluno = $respostaDoAluno->resposta;
                $pergunta->respostaSelecionada = $respostaDoAluno->resposta_selecionada;
                $pergunta->aluno_resposta_id = $respostaDoAluno->id;
            }
        }

        return $queryPerguntas;
    }

    public function getQuizAvaliado($quizId, $alunoId) {
        $modelAlunoQuizzes = TableRegistry::get('AlunoQuizzes');
        $queryAlunoQuizzes = $modelAlunoQuizzes->find('all', [
                    'conditions' => [
                        'AlunoQuizzes.aluno_id' => $alunoId,
                        'AlunoQuizzes.quiz_id' => $quizId
                    ]
                ])->first();

        if(empty($queryAlunoQuizzes)) {
            return false;
        }
        
        $retornarDados = ['notaFinal' => $queryAlunoQuizzes->nota_final];
        $retornarDados['perguntas'] = $this->getPerguntasERespostasAluno($quizId, $alunoId);

        foreach ($retornarDados['perguntas'] as &$perguntaResposta) {
            $queryAlunoQuizNota = $modelAlunoQuizzes->AlunoQuizRespostaNotas->find('all', [
                        'conditions' => [
                            'AlunoQuizRespostaNotas.aluno_quiz_id' => $queryAlunoQuizzes->id,
                            'AlunoQuizRespostaNotas.aluno_resposta_id' => $perguntaResposta->aluno_resposta_id
                        ]
                    ])->first();

            $perguntaResposta->nota = $queryAlunoQuizNota->nota;
            $perguntaResposta->obs = $queryAlunoQuizNota->obs;
        }

        return $retornarDados;
    }

    public static function getTipos() {
        return [
            self::TIPO_OBJETIVA => 'Objetiva',
                //self::TIPO_DISSERTATIVA => 'Dissertativa'
        ];
    }
    
    public static function getNomeTipo($tipo) {
        return self::getTipos()[$tipo];
    }

    public static function getOpcoesGabarito() {
        return [
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E'
        ];
    }

}
