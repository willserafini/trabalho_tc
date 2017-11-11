<div class="tm-white-curve-text">
    <?= $this->Form->create($duvida) ?>
    <fieldset>
        <legend>Cadastrar Dúvida</legend>
        <br />
        <?php
            echo $this->Form->control('assunto');
            echo $this->Form->control('mensagem');
        ?>
    </fieldset>
    <br />
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
    <br />
</div>