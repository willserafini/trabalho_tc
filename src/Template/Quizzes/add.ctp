<?php $this->Html->script('quizzes.js?v=1', ['block' => true]); ?>
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
    <h4>Perguntas da Atividade</h4>
    <?php $opcoesGabarito = App\Model\Table\PerguntasTable::getOpcoesGabarito(); ?>
    <div class="perguntas_quizzes">
        <div class="pergunta_padrao">
            <div class="colunas-3">
                <?php
                echo $this->Form->control('perguntas.0.tipo', ['options' => App\Model\Table\PerguntasTable::getTipos()]);
                echo $this->Form->control('perguntas.0.num_questao', ['value' => 1]);
                echo $this->Form->control('perguntas.0.resposta_correta', ['options' => $opcoesGabarito, 'required' => true]);
                ?>
            </div>
            <div class="clear"></div>
            <?php
            echo $this->Form->control('perguntas.0.questao', ['rows' => 20, 'required' => false]);
            echo '<div class="opcoesLetra colunas-2">';
            foreach ($opcoesGabarito as $key => $opcaoLetra) {
                echo $this->Form->control('perguntas.0.opcoes_resposta_objetiva.' . $key, ['type' => 'textarea', 'rows' => 5, 'label' => 'Opção ' . $opcaoLetra]);
            }

            echo '</div>';
            ?>
        </div>
        <div class="clear"></div>
        <br />
    </div>

    <div class="clear"></div>
    <br />
    <a href="" class="addPergunta">+Adicionar mais uma pergunta</a>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>