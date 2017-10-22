<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Quiz $quiz
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Quiz'), ['action' => 'edit', $quiz->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Quiz'), ['action' => 'delete', $quiz->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quiz->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Quizzes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quiz'), ['action' => 'add']) ?> </li>        
    </ul>
</nav>
<div class="quizzes view large-9 medium-8 columns content">
    <h3>Quiz</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($quiz->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Conteudo') ?></th>
            <td><?= $quiz->has('conteudo') ? $this->Html->link($quiz->conteudo->nome, ['controller' => 'Conteudos', 'action' => 'view', $quiz->conteudo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($quiz->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($quiz->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Perguntas') ?></h4>
        <?php if (!empty($quiz->perguntas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Tipo') ?></th>
                <th scope="col"><?= __('Num Questao') ?></th>
                <th scope="col"><?= __('Questao') ?></th>
                <th scope="col"><?= __('Opcoes Resposta Objetiva') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($quiz->perguntas as $perguntas): ?>
            <tr>
                <td><?= h($perguntas->tipo) ?></td>
                <td><?= h($perguntas->num_questao) ?></td>
                <td><?= h($perguntas->questao) ?></td>
                <td><?= h($perguntas->opcoes_resposta_objetiva) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Perguntas', 'action' => 'view', $perguntas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Perguntas', 'action' => 'edit', $perguntas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Perguntas', 'action' => 'delete', $perguntas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $perguntas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
