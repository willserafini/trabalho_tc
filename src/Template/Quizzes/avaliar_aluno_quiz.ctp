<?php $this->Html->script('avaliarAlunoQuiz', ['block' => true]); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Quizzes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="avaliar-quiz form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Avaliar Aluno em Quiz') ?></legend>
        <?php
        echo $this->Form->control('quiz_id', ['options' => $quizzes, 'label' => 'Quiz do conteúdo']);
        echo $this->Form->control('aluno_id');        
        ?>
    </fieldset>
    <?= $this->Form->button(__('Buscar'), ['name' => 'filtro']) ?>
    <?= $this->Form->end() ?>
</div>


<div class="avaliar-quiz form large-9 medium-8 columns content">
    <?php
    if (isset($respostasAluno)) :
        if (empty($respostasAluno)) :
            echo '<p>Aluno ainda não respodeu esse quiz!</p>';
        else:
            echo $this->element('dar_nota_quiz', $respostasAluno);
        endif;
    endif;
    ?>
</div>