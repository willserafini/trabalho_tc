<div class="columns">
    <h3>Quiz</h3>

    <div class="clearfix"></div>
    <br />

    <?= $this->Form->create(); ?>
    <div class="panel">
        <?php foreach ($quiz->perguntas as $index => $pergunta) : ?>
            <p>Pergunta <?= $pergunta->num_questao ?>. <?= $pergunta->questao ?></p>
            <?= $this->Form->hidden('AlunoResposta.' . $index . '.pergunta_id', ['value' => $pergunta->id]); ?>
            <?= $this->Form->control('AlunoResposta.' . $index . '.resposta', ['type' => 'textarea']); ?>
            <br />
        <?php endforeach; ?>
    </div>

    <?= $this->Form->submit('Enviar', array('class' => 'button')); ?>
    <?= $this->Form->end(); ?>
</div>