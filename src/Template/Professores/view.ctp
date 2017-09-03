<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Professore $professore
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Professore'), ['action' => 'edit', $professore->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Professore'), ['action' => 'delete', $professore->id], ['confirm' => __('Are you sure you want to delete # {0}?', $professore->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Professores'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Professore'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="professores view large-9 medium-8 columns content">
    <h3><?= h($professore->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($professore->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($professore->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Senha') ?></th>
            <td><?= h($professore->senha) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($professore->id) ?></td>
        </tr>
    </table>
</div>
