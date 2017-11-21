<br />
<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel">
        <h2 class="text-center">Revisor de Conteúdos de Computação - RCC</h2>
        <?= $this->Form->create(); ?>
        <?= $this->Form->input('email'); ?>
        <?= $this->Form->input('senha', array('type' => 'password')); ?>
        <?= $this->Form->submit('Entrar', array('class' => 'button')); ?>
        <?= $this->Html->link('Nova Conta', ['action' => 'nova_conta'], array('class' => 'button')); ?>
        <?= $this->Form->end(); ?>
    </div>
</div>
