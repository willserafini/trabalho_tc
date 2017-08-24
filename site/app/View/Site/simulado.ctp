<script>
    $(function() {
        $('#avancar').click(function() {
            $(this).hide();
            $('#texto_aguarde').html('Aguarde um momento...');
        });
});
    
</script>
<?php echo $this->Session->flash(); ?>
<h1 class="disciplina"> <?= Materias::getNomeMateria($materia['MateriaSimulado']['materia']); ?></h1>

<?php echo $this->Form->create('Simulado') ?>
<table class="tableOuter">
    <tbody>
        <tr>
            <td>
                <div class="selectOuter">
                    <?php
                    if ($materia['MateriaSimulado']['materia'] == Materias::REDACAO) :
                        echo $this->Form->input('nota_redacao', ['label' => 'NOTA: ']);
                        echo $this->Form->hidden('redacao');
                    else :
                        for ($i = 1; $i <= $materia['MateriaSimulado']['numero_questoes']; $i++) :
                            ?>
                            <div class="selectContain">
                                <div class="questaoLateral"><?= $i ?></div>
                                <?php
                                $options = array(
                                    'label' => false,
                                    'class' => 'select',
                                    'options' => Simulado::getOpcoesResposta(),
                                    //'default' => 'A', // somente para testes
                                    'empty' => '-',
                                    'div' => false
                                );
                                echo $this->Form->input('questao' . $i, $options);
                                ?>
                            </div>
                            <?php
                        endfor;
                    endif;
                    ?>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div>
    <p class="pezinho">Após marcar as respostas, clique no botão<br>avançar para ir para próxima matéria.</p>

    <input id="avancar" class="botao avanca" type="submit" value="Avançar">
    <p id="texto_aguarde"></p>
</div>
<h3>OBS: ESTÁ TELA SE REPETIRA, PARA CADA MATÉRIA ATÉ O FINAL DO SIMULADO.</h3>
<?php echo $this->Form->end(); ?>