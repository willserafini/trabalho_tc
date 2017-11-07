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
                ['action' => 'delete', $quiz->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $quiz->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Quizzes'), ['action' => 'index']) ?></li>        
    </ul>
</nav>
<div class="quizzes form large-9 medium-8 columns content">
    <?= $this->Form->create($quiz) ?>
    <fieldset>
        <legend><?= __('Edit Quiz') ?></legend>
        <?php
            echo $this->Form->control('conteudo_id', ['options' => $conteudos]);
            echo $this->Form->control('nome');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
