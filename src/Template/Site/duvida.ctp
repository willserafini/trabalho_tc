<div class="columns">
    <h3>Dúvida</h3>
    <div class="clearfix"></div>
    <br />

    <?= $this->Form->create(); ?>
    <div class="panel">
        <?= $this->Form->control('assunto', ['value' => $duvida->assunto, 'readonly' => true]); ?>
        <?= $this->Form->control('mensagem', ['type' => 'textarea', 'value' => $duvida->mensagem, 'readonly' => true]); ?>
        <br />
        <?php
        if (!empty($duvida->feedback_professor)) {
            echo $this->Form->control('feedback_professor', ['label' => 'Resposta do Professor', 'type' => 'textarea', 'value' => $duvida->feedback_professor, 'readonly' => true]);
        }
        ?>
        <br />
    </div>

    <?= $this->Form->end(); ?>
</div>