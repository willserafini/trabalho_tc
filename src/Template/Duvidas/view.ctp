<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Duvida $duvida
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Responder'), ['action' => 'responder', $duvida->id]) ?> </li>
        <li><?= $this->Html->link(__('List Duvidas'), ['action' => 'index']) ?> </li>        
    </ul>
</nav>
<div class="duvidas view large-9 medium-8 columns content">
    <h3>Dúvida</h3>
    <table class="vertical-table">        
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($duvida->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Aluno') ?></th>
            <td><?= $duvida->has('aluno') ? $this->Html->link($duvida->aluno->nome, ['controller' => 'Alunos', 'action' => 'view', $duvida->aluno->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Assunto') ?></th>
            <td><?= h($duvida->assunto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($duvida->created->format('d/m/Y H:i:s')) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($duvida->modified->format('d/m/Y H:i:s')) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Mensagem') ?></h4>
        <?= $this->Text->autoParagraph(h($duvida->mensagem)); ?>
    </div>
    <div class="row">
        <h4><?= __('Feedback Professor') ?></h4>
        <?= $this->Text->autoParagraph(h($duvida->feedback_professor)); ?>
    </div>
</div>
