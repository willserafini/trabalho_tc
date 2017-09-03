<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $professore->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $professore->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Professores'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="professores form large-9 medium-8 columns content">
    <?= $this->Form->create($professore) ?>
    <fieldset>
        <legend><?= __('Editar Professor') ?></legend>
        <?php
            echo $this->Form->control('nome');
            echo $this->Form->control('email');
            echo $this->Form->control('senha');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
