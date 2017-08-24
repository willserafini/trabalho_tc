<h1 class="disciplina">RESULTADO DETALHADO DO SIMULADO</h1>

<div class="detalhadoTopo">
    <h4><?= $simulado['Simulado']['descricao'] ?> DO DIA <?= $this->Time->format('d/m/Y H:i', $simulado['Simulado']['data_inicio']) ?> - <?= $this->Time->format('d/m/Y H:i', $simulado['Simulado']['data_fim']) ?></h4>
</div>
<div class="detalhadoCentro">
    <table class="detalhadoTable">
        <tbody>
            <tr>
                <td class="azulLegal">ALUNO : <?= strtoupper($this->AlunoLogin->getNomeAluno()); ?></td>
            </tr>
            <tr>
                <td colspan="6" class="transparente"></td>
            </tr>
            <tr>
                <?php if (!$this->Simulado->isSimuladoENEM($simulado['Simulado']['id'])) : ?>
                    <td class="azulLegal">NOTA TOTAL : <?= $simulado['AlunoSimulado']['media_final']; ?></td>
                    <td class="transparente"></td>
                <?php endif; ?>
                <td class="azulLegal">TOTAL DE ACERTOS : <?= $simulado['AlunoSimulado']['numero_acertos']; ?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table class="detalhadoTable">
        <tbody>
            <tr>
                <td class="azulLegal" style="width: 266px;">DESEMPENHO POR MATÉRIA</td>
                <td class="transparente"></td>
                <?php if (!$this->Simulado->isSimuladoENEM($simulado['Simulado']['id'])) : ?>
                    <td class="azulLegal">NOTA</td>
                    <td class="transparente"></td>
                <?php endif; ?>
                <td class="azulLegal">ACERTOS</td>
                <td class="transparente"></td>
                <td class="azulLegal">TOTAL DE QUESTÕES</td>
                <td class="transparente"></td>
            </tr>
            <tr>
                <td colspan="6" class="transparente"></td>
            </tr>
            <?php foreach ($dados_materias as $materia) : ?>
                <tr>
                    <td class="azulLegal"><?= Materias::getNomeMateria($materia['AlunoSimuladoMateria']['materia']); ?></td>
                    <td class="transparente"></td>
                    <?php if (!$this->Simulado->isSimuladoENEM($simulado['Simulado']['id'])) : ?>
                        <td class="azulLegal"><?= $materia['AlunoSimuladoMateria']['media'] ?></td>
                        <td class="transparente"></td>
                    <?php endif; ?>
                    <td class="azulLegal"><?php echo $this->Simulado->mostrarNumeroAcertos($simulado['Simulado']['id'], $materia['AlunoSimuladoMateria']['id']); ?></td>
                    <td class="transparente"></td>
                    <td class="azulLegal"><?php echo $this->Simulado->getTotalQuestoesMateria($simulado['Simulado']['id'], $materia['AlunoSimuladoMateria']['materia']); ?></td>
                    <td class="transparente"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($this->Simulado->simuladoTemRedacao($simulado['Simulado']['id'])) : ?>
        <table class="detalhadoTable">
            <tbody>
                <tr>
                    <td class="azulLegal" style="width: 266px;">NOTA REDAÇÃO</td>
                    <td class="transparente"></td>
                    <td class="azulLegal"><?php echo $this->Simulado->getNotaRedacao($simulado['Simulado']['id']); ?></td>
                    <td class="transparente"></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>

</div>
<div class="detalhadoInferior"></div>

<?php if (!$this->Simulado->isSimuladoENEM($simulado['Simulado']['id'])) : ?>
    <?php echo $this->element('site/grafico', array('dados' => $dados_materias)); ?>
<?php endif; ?>

<div class="abc">A CADA SIMULADO FEITO VOCÊ VAI RECEBER SEU
    RESULTADO AUTOMATICAMENTE NO E-MAIL CADASTRADO</div>

<div style="display:inline" method="post">
    <a class="botao inicio" href="<?php echo $this->Html->url('/index') ?>">Inicio</a>
    <?php echo $this->Html->link('Sair', '/logout', array('class' => 'botao', 'style' => 'text-align: center;')); ?>
</div>