<div class="columns">
    <h3>Quiz</h3>

    <div class="clearfix"></div>
    <br />

    <?= $this->Form->create(); ?>
    <div class="panel">
        <?php
        $podeEditar = true;
        $readOnly = false;
        foreach ($quizPerguntas as $index => $pergunta) :
            if (!empty($pergunta->aluno_resposta_id)) {
                $podeEditar = false;
                $readOnly = true;
            }
            ?>
            <p>Pergunta <?= $pergunta->num_questao ?>. <?= $pergunta->questao ?></p>
            <?= $this->Form->hidden('AlunoResposta.' . $index . '.id', ['value' => $pergunta->aluno_resposta_id]); ?>
            <?= $this->Form->hidden('AlunoResposta.' . $index . '.quiz_id', ['value' => $pergunta->quiz_id]); ?>
            <?= $this->Form->hidden('AlunoResposta.' . $index . '.pergunta_id', ['value' => $pergunta->id]); ?>
            <?= $this->Form->control('AlunoResposta.' . $index . '.resposta', ['type' => 'textarea', 'value' => $pergunta->respostaAluno, 'required' => true, 'readonly' => $readOnly]); ?>
            <br />
        <?php endforeach; ?>
    </div>

    <?php if ($podeEditar) : ?>
        <?= $this->Form->submit('Enviar', array('class' => 'button')); ?>
    <?php endif; ?>
    <?= $this->Form->end(); ?>
</div>