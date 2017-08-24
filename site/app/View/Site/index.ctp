<?php echo $this->Session->flash(); ?>
<div class="dadosUsuario">
    <?php $aluno = $this->AlunoLogin->getDadosAluno(); ?>
    <?php
    $nome = $aluno['Aluno']['nome'];
    if ($this->AlunoLogin->isResponsavel()) {
        $nome = $aluno['Aluno']['resp_nome'] . ' responsável por ' . $aluno['Aluno']['nome'];
    }
    ?>
    <p>SEJA BEM VINDO: <?= $nome ?></p>

    <p>NÚMERO DE MATRÍCULA: <?= $aluno['Aluno']['matricula'] ?></p>

    <p>LINGUA ESTRANGEIRA: <?= Aluno::getNomeLinguaEstrangeira($aluno['Aluno']['lingua_estrangeira']) ?></p>

    <h2>SELECIONE O SIMULADO DESEJADO PARA INICIAR</h2>
</div>

<div class="recursos">
    <table class="full-width">
        <tbody>
            <?php
            if (!empty($simulados)):
                foreach ($simulados as &$simulado):
                    $url = $this->Html->url('/simulado/' . $simulado['Simulado']['id']);
                    $texto = 'ATIVO';
                    $class = 'ativo';
                    if (Simulado::isFinalizado($simulado['Simulado']['id'], $aluno['Aluno']['id']) || Simulado::tempoAcabou($simulado['Simulado']['data_inicio'], $simulado['Simulado']['data_fim'])) {
                        $url = $this->Html->url('/simulado_encerrado/' . $simulado['Simulado']['id']);
                        $texto = Simulado::getMediaSimulado($simulado['Simulado']['id'], $aluno['Aluno']['id']);
                        $class = 'encerrado';

                        if ($this->Simulado->isSimuladoENEM($simulado['Simulado']['id'])) {
                            $texto = 'ENCERRADO';
                        }
                    }
                    ?>
                    <tr>
                        <td class="detalheData"><?= $this->Time->format('d/m/Y H:i', $simulado['Simulado']['data_inicio']) ?> - <?= $this->Time->format('d/m/Y H:i', $simulado['Simulado']['data_fim']) ?></td>
                        <td class="detalheSimulado"><div class="round"><?= $simulado['Simulado']['descricao'] ?></div></td>
                        <td class="detalheData" width="105" align="center">
                            <a class="acessar" href="<?php echo $url ?>">ACESSAR</a>
                        </td>

                        <td class="detalheData" width="105" align="center">
                            <div class="<?= $class ?>"><?= $texto ?></div>
                        </td>
                    </tr> 
        <?php
    endforeach;
endif;
?>                         
        </tbody>
    </table>
</div>

<h3>CASO QUEIRA VISUALIZAR UM SIMULADO JÁ FEITO CLIQUE NO BOTÃO ACESSAR</h3>

<?php echo $this->element('site/grafico', array('dados' => $simulados, 'isSimulados' => true)); ?>

<fieldset>
    <legend>OBSERVAÇÕES</legend>
    <div>SIMULADOS ESTARÃO DISPONIVEL POR UM DETERMINADO TEMPO</div>
    <div>PARA SEREM FEITOS, CONFIRA LEGENDA DE CORES DISPONÍVEL ENCERRADO</div>
    <hr>
    <div class="seiLa">
        <span class="disponivelBox"></span>
        <span class="left" style="line-height:25px; width:128px">DISPONÍVEL</span>
        <span class="encerradoBox"></span>
        <span class="left" style="line-height:25px;width:128px">ENCERRADO</span>
    </div>
</fieldset>

<div style="margin: 0 auto; width: 190px;">
<?php echo $this->Html->link('Sair', '/logout', array('class' => 'botao', 'style' => 'text-align: center;')); ?>
</div>
