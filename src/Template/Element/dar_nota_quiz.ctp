<div class="columns">
    <?= $this->Form->create('AvaliarAlunoQuiz'); ?>
    <?= $this->Form->hidden('AlunoQuiz.aluno_id', ['value' => $alunoId]); ?>
    <?= $this->Form->hidden('AlunoQuiz.quiz_id', ['value' => $quizId]); ?>
    <div class="panel">        
        <?php
        foreach ($respostasAluno as $index => $respostaAluno) :
            ?>
            <p>Pergunta <?= $respostaAluno->pergunta->num_questao ?>. <?= $respostaAluno->pergunta->questao ?></p>
            <?= $this->Form->control('Conf.' . $index . '.resposta', ['type' => 'textarea', 'value' => $respostaAluno->resposta, 'readonly' => true]); ?>
            <?= $this->Form->hidden('AlunoQuizRespostaNota.' . $index . '.aluno_resposta_id', ['value' => $respostaAluno->id]); ?>
            <?= $this->Form->control('AlunoQuizRespostaNota.' . $index . '.nota', ['type' => 'number', 'step' => '.01', 'required' => true, 'class' => 'notaResposta']); ?>
            <?= $this->Form->control('AlunoQuizRespostaNota.' . $index . '.obs', ['type' => 'text']); ?>
            <br />
        <?php endforeach; ?>

        <?= $this->Form->control('AlunoQuiz.nota_final', ['type' => 'number', 'step' => '.01', 'required' => true]); ?>
        <a href="" id="CalcularNotaFinal">Calcular nota final</a>
    </div>
    <?= $this->Form->submit('Enviar', array('class' => 'button', 'name' => 'avaliar_aluno')); ?>
    <?= $this->Form->end(); ?>
</div>