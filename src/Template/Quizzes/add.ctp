<?php $this->Html->script('quizzes', ['block' => true]); ?>
<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Quizzes'), ['action' => 'index']) ?></li>        
    </ul>
</nav>
<div class="quizzes form large-9 medium-8 columns content">
    <?= $this->Form->create($quiz) ?>
    <fieldset>
        <legend><?= __('Add Quiz') ?></legend>
        <?php 
        echo $this->Form->control('conteudo_id', ['options' => $conteudos]);
        echo $this->Form->control('nome');
        ?>
    </fieldset>
    <h4>Perguntas do Quiz</h4>
    <div class="perguntas_quizzes">
        <div class="pergunta_padrao">
            <?php
            echo $this->Form->control('perguntas.0.tipo', ['options' => App\Model\Table\PerguntasTable::getTipos()]);
            echo $this->Form->control('perguntas.0.num_questao', ['value' => 1]);
            echo $this->Form->control('perguntas.0.questao');
            //echo $this->Form->control('perguntas.0.opcoes_resposta_objetiva'); 
            ?>
            <br />
        </div>
    </div>
    <a href="" class="addPergunta">Adicionar mais uma pergunta</a>

    <?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>