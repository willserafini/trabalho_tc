<h1 class="disciplina">RESULTADO DETALHADO DO SIMULADO</h1>

<div class="simuladoFinal">
    <h4><?= $simulado['Simulado']['descricao'] ?> DO DIA <?= $this->Time->format('d/m/Y H:i', $simulado['Simulado']['data_inicio']) ?> - <?= $this->Time->format('d/m/Y H:i', $simulado['Simulado']['data_fim']) ?></h4>
    <?php if ($this->Simulado->isSimuladoENEM($simulado['Simulado']['id'])) : ?>
        <div class="espacamento"></div>        
    <?php else : ?>
        <div class="nota"><?= $simulado['AlunoSimulado']['media_final']; ?></div>
        <div class="suaNota">SUA NOTA</div>
    <?php endif; ?>
    <?php $palavraAcertos = $simulado['AlunoSimulado']['numero_acertos'] > 1 ? 'ACERTOS' : 'ACERTO'; ?>
    <h4>VOCÊ OBTEVE <?= $simulado['AlunoSimulado']['numero_acertos'] . ' ' . $palavraAcertos ?></h4>
    <h4><a href="<?php echo $this->Html->url('/detalhes_simulado/' . $simulado['Simulado']['id']) ?>">VISUALIZAR DETALHES DO SIMULADO</a></h4>
</div>

<div class="abc">A CADA SIMULADO FEITO VOCÊ VAI RECEBER SEU
    RESULTADO AUTOMATICAMENTE NO E-MAIL CADASTRADO</div>

<div class="botoes_encerrado">
    <div style="display:inline; text-align: center">
        <a class="botao" href="<?php echo $this->Html->url('/index') ?>">Início</a>
    </div>

    <div style="display:inline">
        <?php echo $this->Html->link('Sair', '/logout', array('class' => 'botao', 'style' => 'text-align: center;')); ?>
    </div>
</div>