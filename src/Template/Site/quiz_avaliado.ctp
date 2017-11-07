<div class="columns">
    <h3><?= $quizNome ?></h3>    
    <div class="clearfix"></div>
    <br />
    <div class="panel">
        <?php foreach ($quizPerguntas['perguntas'] as $index => $pergunta) : ?>
            <p>Pergunta <?= $pergunta->num_questao ?>. <?= $pergunta->questao ?></p>
            <?= $this->Form->control('Conf.' . $index . '.resposta', ['type' => 'textarea', 'value' => $pergunta->respostaAluno, 'readonly' => true]); ?>
            <?= $this->Form->control('Conf.' . $index . '.nota', ['value' => $pergunta['nota'], 'readonly' => true]); ?>
            <?= $this->Form->control('Conf.' . $index . '.obs', ['value' => $pergunta['obs'], 'readonly' => true]); ?>
            <br />
        <?php endforeach; ?>

        <?= $this->Form->control('Conf.nota_final', ['value' => $quizPerguntas['notaFinal'], 'readonly' => true]); ?>
    </div>
</div>