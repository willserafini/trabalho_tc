<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Conteudo[]|\Cake\Collection\CollectionInterface $conteudos
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Conteudo'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="conteudos index large-9 medium-8 columns content">
    <h3><?= __('Conteudos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('conteudo_id', 'Conteúdo Pai') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ordem') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($conteudos as $conteudo): ?>
            <tr>
                <td><?= $this->Number->format($conteudo->id) ?></td>
                <td><?php echo $conteudo->conteudo_pai ? $conteudo->conteudo_pai->nome : ''; ?>&nbsp;</td>
                <td><?= h($conteudo->nome) ?></td>
                <td><?= $this->Number->format($conteudo->ordem) ?></td>
                <td><?= h($conteudo->created->format('d/m/Y H:i:s')) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $conteudo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $conteudo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $conteudo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conteudo->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
