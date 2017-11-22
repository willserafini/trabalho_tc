<div class="quizzes index large-9 medium-8 columns content">
    <h3><?= __('Relatórios') ?></h3>
    <ul>
        <!--<li><?php //echo $this->Html->link(__('Avaliar Aluno-Atividade'), ['controller' => 'relatorios', 'action' => 'avaliar_aluno_quiz'])  ?></li>-->
        <li><?= $this->Html->link(__('Desempenho Aluno-Atividades'), ['controller' => 'relatorios', 'action' => 'desempenho_aluno_quizzes']) ?></li>        
        <li><?= $this->Html->link(__('Acertos/Erros nas Atividades'), ['controller' => 'relatorios', 'action' => 'acerto_erros_atividades']) ?></li> 
    </ul>

</div>
