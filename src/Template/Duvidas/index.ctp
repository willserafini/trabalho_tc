<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Duvida[]|\Cake\Collection\CollectionInterface $duvidas
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Alunos'), ['controller' => 'Alunos', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="duvidas index large-9 medium-8 columns content">
    <h3><?= __('Duvidas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('aluno_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assunto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($duvidas as $duvida): ?>
            <tr>
                <td><?= $duvida->has('aluno') ? $this->Html->link($duvida->aluno->nome, ['controller' => 'Alunos', 'action' => 'view', $duvida->aluno->id]) : '' ?></td>
                <td><?= h($duvida->assunto) ?></td>
                <td><?= h($duvida->created->format('d/m/Y H:i:s')) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $duvida->id]) ?>
                    <?= $this->Html->link(__('Responder'), ['action' => 'responder', $duvida->id]) ?>
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
