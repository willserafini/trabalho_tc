<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Duvidas'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="duvidas form large-9 medium-8 columns content">
    <?= $this->Form->create($duvida) ?>
    <fieldset>
        <legend><?= __('Responder Dúvida') ?></legend>
        <?php
        echo $this->Form->control('Conf.aluno', ['type' => 'text', 'value' => $duvida->aluno->nome, 'readonly' => true]);
        echo $this->Form->control('Conf.assunto', ['value' => $duvida->assunto, 'readonly' => true]);
        echo $this->Form->control('Conf.mensagem', ['value' => $duvida->mensagem, 'readonly' => true]);
        echo $this->Form->control('feedback_professor', ['required' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</div>
