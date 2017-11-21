<?php
/**
 * @var \App\View\AppView $this
 */
?>
<script>tinymce.init({ selector:'textarea' });</script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?=
            $this->Form->postLink(
                    __('Delete'), ['action' => 'delete', $pergunta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pergunta->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Quizzes'), ['controller' => 'Quizzes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quiz'), ['controller' => 'Quizzes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="perguntas form large-9 medium-8 columns content">
    <?= $this->Form->create($pergunta) ?>
    <fieldset>
        <legend><?= __('Edit Pergunta') ?></legend>
        <?php $opcoesGabarito = App\Model\Table\PerguntasTable::getOpcoesGabarito(); ?>
        <div class="pergunta_padrao">
            <div class="colunas-3">
                <?php
                echo $this->Form->control('tipo', ['options' => App\Model\Table\PerguntasTable::getTipos()]);
                echo $this->Form->control('num_questao');
                echo $this->Form->control('resposta_correta', ['options' => $opcoesGabarito, 'required' => true]);
                ?>
            </div>
            <div class="clear"></div>
            <?php
            echo $this->Form->control('questao', ['required' => false, 'rows' => 20]);
            echo '<div class="opcoesLetra colunas-2">';
            
            $opcoesResposta = json_decode($pergunta->opcoes_resposta_objetiva, true);
            foreach ($opcoesGabarito as $key => $opcaoLetra) {
                echo $this->Form->control('opcoes_resposta_objetiva.' . $key, 
                        ['type' => 'textarea', 'value' => $opcoesResposta[$key], 'rows' => 10, 'label' => 'Opção ' . $opcaoLetra]);
            }

            echo '</div>';
            ?>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
