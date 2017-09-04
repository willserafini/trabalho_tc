<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Conteudo $conteudo
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Conteudo'), ['action' => 'edit', $conteudo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Conteudo'), ['action' => 'delete', $conteudo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conteudo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Conteudos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Conteudo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Conteudos'), ['controller' => 'Conteudos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Conteudo'), ['controller' => 'Conteudos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="conteudos view large-9 medium-8 columns content">
    <h3><?= h($conteudo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($conteudo->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Anexo Img') ?></th>
            <td><?= h($conteudo->anexo_img) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Anexo Doc') ?></th>
            <td><?= h($conteudo->anexo_doc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($conteudo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Conteudo Id') ?></th>
            <td><?= $this->Number->format($conteudo->conteudo_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordem') ?></th>
            <td><?= $this->Number->format($conteudo->ordem) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($conteudo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($conteudo->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Descricao') ?></h4>
        <?= $this->Text->autoParagraph(h($conteudo->descricao)); ?>
    </div>
    <div class="row">
        <h4><?= __('Explicacao Geral') ?></h4>
        <?= $this->Text->autoParagraph(h($conteudo->explicacao_geral)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Conteudos') ?></h4>
        <?php if (!empty($conteudo->conteudos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Conteudo Id') ?></th>
                <th scope="col"><?= __('Nome') ?></th>
                <th scope="col"><?= __('Descricao') ?></th>
                <th scope="col"><?= __('Anexo Img') ?></th>
                <th scope="col"><?= __('Anexo Doc') ?></th>
                <th scope="col"><?= __('Explicacao Geral') ?></th>
                <th scope="col"><?= __('Ordem') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($conteudo->conteudos as $conteudos): ?>
            <tr>
                <td><?= h($conteudos->id) ?></td>
                <td><?= h($conteudos->conteudo_id) ?></td>
                <td><?= h($conteudos->nome) ?></td>
                <td><?= h($conteudos->descricao) ?></td>
                <td><?= h($conteudos->anexo_img) ?></td>
                <td><?= h($conteudos->anexo_doc) ?></td>
                <td><?= h($conteudos->explicacao_geral) ?></td>
                <td><?= h($conteudos->ordem) ?></td>
                <td><?= h($conteudos->created) ?></td>
                <td><?= h($conteudos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Conteudos', 'action' => 'view', $conteudos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Conteudos', 'action' => 'edit', $conteudos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Conteudos', 'action' => 'delete', $conteudos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conteudos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
