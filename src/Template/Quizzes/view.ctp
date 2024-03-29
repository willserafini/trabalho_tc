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
    <h3>Atividade</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($quiz->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Conteudo') ?></th>
            <?php
            $conteudoPaiNome = '';
            if (!empty($quiz->conteudo->conteudo_pai)) {
                $conteudoPaiNome = $quiz->conteudo->conteudo_pai->nome . '-';
            }
            ?>
            <td><?= $quiz->has('conteudo') ? $this->Html->link($conteudoPaiNome . $quiz->conteudo->nome, ['controller' => 'Conteudos', 'action' => 'view', $quiz->conteudo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($quiz->nome) ?></td>
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
                    <th scope="col"><?= __('Resposta Correta') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($quiz->perguntas as $perguntas): ?>
                    <tr>
                        <td><?= \App\Model\Table\PerguntasTable::getNomeTipo($perguntas->tipo) ?></td>
                        <td><?= h($perguntas->num_questao) ?></td>
                        <td><?= h($perguntas->resposta_correta) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Perguntas', 'action' => 'edit', $perguntas->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Perguntas', 'action' => 'delete', $perguntas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $perguntas->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
