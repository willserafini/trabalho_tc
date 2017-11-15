<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * AlunoRespostas Model
 *
 * @property \App\Model\Table\AlunosTable|\Cake\ORM\Association\BelongsTo $Alunos
 * @property \App\Model\Table\PerguntasTable|\Cake\ORM\Association\BelongsTo $Perguntas
 *
 * @method \App\Model\Entity\AlunoResposta get($primaryKey, $options = [])
 * @method \App\Model\Entity\AlunoResposta newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AlunoResposta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AlunoResposta|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AlunoResposta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AlunoResposta[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AlunoResposta findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AlunoRespostasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('aluno_respostas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Alunos', [
            'foreignKey' => 'aluno_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Quizzes', [
            'foreignKey' => 'quiz_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Perguntas', [
            'foreignKey' => 'pergunta_id',
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
                ->scalar('resposta')
                ->requirePresence('resposta', 'create')
                ->notEmpty('resposta');

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
        $rules->add($rules->existsIn(['quiz_id'], 'Quizzes'));
        $rules->add($rules->existsIn(['pergunta_id'], 'Perguntas'));

        return $rules;
    }

    public function salvarRespostasAluno($dados, $alunoId) {
        $quizId = $dados['AlunoResposta'][0]['quiz_id'];
        foreach ($dados['AlunoResposta'] as $resposta) {
            if (empty($resposta['id'])) {
                //novo registro de resposta do aluno
                $objAlunoResposta = $this->newEntity();
                unset($resposta['id']);
            } else {
                //atualiza a resposta do aluno
                $objAlunoResposta = $this->get($resposta['id']);
            }

            $objAlunoResposta->aluno_id = $alunoId;
            $objAlunoResposta->quiz_id = $resposta['quiz_id'];
            $objAlunoResposta->pergunta_id = $resposta['pergunta_id'];
            $objAlunoResposta->resposta_selecionada = $resposta['resposta_selecionada'];

            if (!$this->save($objAlunoResposta)) {
                throw new Exception('Não foi possível salvar as respostas!');
            }
        }

        $this->calculaNotaQuiz($alunoId, $quizId);
    }

    private function calculaNotaQuiz($alunoId, $quizId) {
        $modelAlunoQuizzes = TableRegistry::get('AlunoQuizzes');
        $modelAlunoQuizRespostaNotas = TableRegistry::get('AlunoQuizRespostaNotas');
        $novoAlunoQuizDefault = [
            'aluno_id' => $alunoId,
            'quiz_id' => $quizId,
            'nota_final' => 0.00
        ];
        $alunoQuiz = $modelAlunoQuizzes->newEntity($novoAlunoQuizDefault);
        if (!$modelAlunoQuizzes->save($alunoQuiz)) {
            throw new Exception('Não foi possível salvar a nota final!');
        }

        $idNovoAlunoQuiz = $alunoQuiz->id;
        $novoAlunoRespostaNota = [
            'aluno_quiz_id' => $idNovoAlunoQuiz
        ];
        $notaFinal = 0;
        $queryPerguntas = $this->Perguntas->find('all', ['conditions' => ['Perguntas.quiz_id' => $quizId]])->all()->toArray();
        $qntPerguntas = count($queryPerguntas);
        $pontuacaoAcertoPergunta = 10/$qntPerguntas; //deixei como parametro 10 o max de nota para um quiz
        foreach ($queryPerguntas as $pergunta) {
            $respostaCorreta = $pergunta->resposta_correta;
            $queryAlunoResposta = $this->find('all', [
                        'conditions' => [
                            'AlunoRespostas.aluno_id' => $alunoId,
                            'AlunoRespostas.quiz_id' => $quizId,
                            'AlunoRespostas.pergunta_id' => $pergunta->id,
                        ]
                    ])->first();

            $novoAlunoRespostaNota['aluno_resposta_id'] = $queryAlunoResposta->id;
            $novoAlunoRespostaNota['nota'] = 0;
            $novoAlunoRespostaNota['obs'] = 'Resposta Correta é a Letra ' . $respostaCorreta;
            if ($queryAlunoResposta->resposta_selecionada == $respostaCorreta) {
                $novoAlunoRespostaNota['nota'] = $pontuacaoAcertoPergunta;
                $novoAlunoRespostaNota['obs'] = 'Resposta Correta!';
                $notaFinal += $pontuacaoAcertoPergunta;
            }

            $alunoRespostaNota = $modelAlunoQuizRespostaNotas->newEntity($novoAlunoRespostaNota);
            if (!$modelAlunoQuizRespostaNotas->save($alunoRespostaNota)) {
                throw new Exception('Não foi possível salvar a nota final!');
            }
        }

        $alunoQuiz->nota_final = $notaFinal;
        $modelAlunoQuizzes->save($alunoQuiz);
    }

}
