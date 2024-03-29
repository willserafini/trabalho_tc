<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Exception;

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
        $this->setDisplayField('nome');
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

        $validator
                ->scalar('nome')
                ->requirePresence('nome', 'create')
                ->notEmpty('nome');

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
        foreach ($dados['perguntas'] as &$pergunta) {
            $pergunta['opcoes_resposta_objetiva'] = json_encode($pergunta['opcoes_resposta_objetiva']);
        }
        
        $quiz = $this->newEntity($dados, ['associated' => ['Perguntas']]);
        if (!$this->save($quiz)) {
            throw new Exception('Não foi possível salvar o quiz!');            
            debug($quiz->getErrors());
        }
    }

    public function getQuizzesDisponiveis($alunoId) {
        return $this->getQuizzes($alunoId);        
    }
    
    private function getQuizzes($alunoId) {
        $quizzes = $this->find('all')->toArray();
        foreach ($quizzes as &$quiz) {
            $quiz->is_avaliado = $this->alunoJaFoiAvaliado($alunoId, $quiz->id);
        }
        
        return $quizzes;
    }

    public function listAlunosQueNaoForamAvaliados($quizId) {
        $alunos = TableRegistry::get('Alunos')->find('list')->toArray();

        foreach ($alunos as $alunoId => $aluno) {
            if ($this->alunoJaFoiAvaliado($alunoId, $quizId)) {
                unset($alunos[$alunoId]);
            }
        }

        return $alunos;
    }

    public function alunoJaFoiAvaliado($alunoId, $quizId) {
        $modelAlunoQuizzes = TableRegistry::get('AlunoQuizzes');
        $query = $modelAlunoQuizzes->find('all', [
            'conditions' => [
                'AlunoQuizzes.aluno_id' => $alunoId,
                'AlunoQuizzes.quiz_id' => $quizId
            ],
        ]);
        $alunoAvaliado = $query->first();
        if (!empty($alunoAvaliado)) {
            return true;
        }

        return false;
    }

    public function buscaDadosRespostasAluno($alunoId, $quizId) {
        $modelAlunoRespostas = TableRegistry::get('AlunoRespostas');
        $query = $modelAlunoRespostas->find('all', [
                    'conditions' => [
                        'AlunoRespostas.aluno_id' => $alunoId,
                        'AlunoRespostas.quiz_id' => $quizId
                    ],
                ])->contain(['Perguntas']);
        return $query->all()->toArray();
    }

    public function salvarNota($dados) {
        $modelAlunoQuizzes = TableRegistry::get('AlunoQuizzes');
        $modelAlunoQuizRespostaNotas = TableRegistry::get('AlunoQuizRespostaNotas');
        $alunoQuiz = $modelAlunoQuizzes->newEntity($dados['AlunoQuiz']);
        if (!$modelAlunoQuizzes->save($alunoQuiz)) {
            throw new Exception('Não foi possível salvar a nota final!');
        }

        $alunoQuizId = $alunoQuiz->id;
        foreach ($dados['AlunoQuizRespostaNota'] as $notaResposta) {
            $notaResposta['aluno_quiz_id'] = $alunoQuizId;
            $alunoRespostaNota = $modelAlunoQuizRespostaNotas->newEntity($notaResposta);
            if (!$modelAlunoQuizRespostaNotas->save($alunoRespostaNota)) {
                throw new Exception('Não foi possível salvar a nota final!');
            }
        }
    }

    public function getNotasQuizzesAluno($alunoId) {
        $modelAlunoQuizzes = TableRegistry::get('AlunoQuizzes');
        $query = $modelAlunoQuizzes->find('all', [
                    'conditions' => [
                        'AlunoQuizzes.aluno_id' => $alunoId
                    ],
                    'fields' => ['AlunoQuizzes.nota_final', 'Quizzes.nome']
                ])->contain(['Quizzes']);

        return $query->toArray();
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
