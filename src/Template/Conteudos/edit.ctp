<?php $this->Html->script('carregaConteudosAnteriores', ['block' => true]); ?>
<script>tinymce.init({
        plugins: "table",
        table_appearance_options: false,
        selector: 'textarea'
    });
</script>

<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?=
            $this->Form->postLink(
                    __('Delete'), ['action' => 'delete', $conteudo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conteudo->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Conteudos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Conteudo'), ['controller' => 'Conteudos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="conteudos form large-10 medium-8 columns content">
    <?= $this->Form->create($conteudo, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit Conteudo') ?></legend>        
        <?php echo $this->Form->control('is_primeiro_conteudo'); ?>
        <div class="colunas-2">
            <?php
            echo $this->Form->control('conteudo_id', array('label' => 'Conteúdo Pai', 'empty' => 'Nenhum'));
            echo $this->Form->control('conteudo_anterior_id', array('empty' => true, 'data-default' => $conteudo->conteudo_anterior_id));
            ?>
        </div>
        <div class="clear"></div>
        <?php echo $this->Form->control('nome'); ?>
        <div class="colunas-2">
            <?php
            echo $this->Form->control('descricao', ['rows' => 30]);
            echo $this->Form->control('explicacao_geral', ['rows' => 30]);
            ?>
        </div>
        <div class="clear"></div>
        <?php
        echo $this->Form->control('anexo_img', ['type' => 'file']);
        echo $this->Form->control('anexo_doc', ['type' => 'file']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
