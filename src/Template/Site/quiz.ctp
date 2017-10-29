<div class="columns">
    <h3>Quiz</h3>

    <div class="clearfix"></div>
    <br />

    <?= $this->Form->create(); ?>
    <div class="panel">
        <?php foreach ($quizPerguntas as $index => $pergunta) : ?>
            <p>Pergunta <?= $pergunta->num_questao ?>. <?= $pergunta->questao ?></p>
            <?= $this->Form->hidden('AlunoResposta.' . $index . '.id', ['value' => $pergunta->aluno_resposta_id]); ?>
            <?= $this->Form->hidden('AlunoResposta.' . $index . '.quiz_id', ['value' => $pergunta->quiz_id]); ?>
            <?= $this->Form->hidden('AlunoResposta.' . $index . '.pergunta_id', ['value' => $pergunta->id]); ?>
            <?= $this->Form->control('AlunoResposta.' . $index . '.resposta', ['type' => 'textarea', 'value' => $pergunta->respostaAluno]); ?>
            <br />
        <?php endforeach; ?>
    </div>

    <?= $this->Form->submit('Enviar', array('class' => 'button')); ?>
    <?= $this->Form->end(); ?>
</div>