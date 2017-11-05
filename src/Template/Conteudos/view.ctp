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
    </ul>
</nav>
<div class="conteudos view large-9 medium-8 columns content">
    <h3>Conteúdo</h3>
    <table class="vertical-table">        
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($conteudo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Conteudo Id') ?></th>
            <td><?php echo $conteudo->conteudo_pai ? $conteudo->conteudo_pai->nome : ''; ?>&nbsp;</td>
        </tr>        
        <tr>
            <th scope="row"><?= __('Conteudo Anterior') ?></th>
            <td><?php echo $conteudo->conteudo_anterior ? $conteudo->conteudo_anterior->nome : ''; ?>&nbsp;</td>
        </tr>
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
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($conteudo->created->format('d/m/Y H:i:s')) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($conteudo->modified->format('d/m/Y H:i:s')) ?></td>
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
        <?php if (!empty($conteudo->conteudo_filho)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nome') ?></th>
                <th scope="col"><?= __('Ordem') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($conteudo->conteudo_filho as $conteudos): ?>
            <tr>
                <td><?= h($conteudos->id) ?></td>
                <td><?= h($conteudos->nome) ?></td>
                <td><?= h($conteudos->ordem) ?></td>
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
