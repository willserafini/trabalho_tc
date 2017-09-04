<br>
<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel">
        <h2 class="text-center">Nova Conta</h2>
        <?= $this->Form->create($aluno); ?>
        <?php
        $this->Form->templates(
                ['dateWidget' => '{{day}}/{{month}}/{{year}}']
        );
        echo $this->Form->control('nome');
        echo $this->Form->control('email');
        echo $this->Form->control('senha', ['type' => 'password']);
        echo $this->Form->control('data_nascimento', [
            'minYear' => date('Y') - 70,
            'maxYear' => date('Y') - 15]);
        echo $this->Form->control('curso', ['options' => App\Model\Table\AlunosTable::getCursos()]);
        ?>
        <?= $this->Form->submit('Criar', array('class' => 'button')); ?>
        <?= $this->Form->end(); ?>
    </div>
</div>