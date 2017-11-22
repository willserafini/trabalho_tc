<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Listar Relatórios'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="desempenho-quiz form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Desempenho Aluno em Quizzes') ?></legend>
        <?php
        echo $this->Form->control('aluno_id');        
        ?>
    </fieldset>
    <?= $this->Form->button(__('Buscar')) ?>
    <?= $this->Form->end() ?>
</div>


<div class="desempenho-quiz form large-9 medium-8 columns content">
    <?php
    if (isset($notasQuizzes)) :
        if (empty($notasQuizzes)) :
            echo '<p>Aluno ainda não tem notas!</p>';
        else:
            echo $this->element('desempenho_aluno_quizzes', $notasQuizzes);
        endif;
    endif;
    ?>
</div>