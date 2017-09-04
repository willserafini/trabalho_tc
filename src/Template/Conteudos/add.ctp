<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Conteudos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Conteudos'), ['controller' => 'Conteudos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Conteudo'), ['controller' => 'Conteudos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="conteudos form large-9 medium-8 columns content">
    <?= $this->Form->create($conteudo) ?>
    <fieldset>
        <legend><?= __('Add Conteudo') ?></legend>
        <?php
            echo $this->Form->control('conteudo_id');
            echo $this->Form->control('nome');
            echo $this->Form->control('descricao');
            echo $this->Form->control('anexo_img');
            echo $this->Form->control('anexo_doc');
            echo $this->Form->control('explicacao_geral');
            echo $this->Form->control('ordem');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
