
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Matéria', 'Notas'],
<?php
foreach ($dados as $dado) :

    if (isset($isSimulados)) {
        if ($this->Simulado->isSimuladoENEM($dado['Simulado']['id'])) {
            continue;
        }
        
        $id = $dado['Simulado']['id'];
        $nome = $dado['Simulado']['descricao'];
        $media = Simulado::getMediaSimulado($dado['Simulado']['id'], $this->AlunoLogin->getIdAluno());
    } elseif (isset($evolucaoMaterias)) {
        $id = $materia;
        $nome = $dado['lista'];
        $media = $dado['media'];
    } elseif (isset($ranking)) {
        $id = $dado['Aluno']['id'];
        $nome = $dado['Aluno']['nome'];
        $media = isset($dado[0]['media']) ? $dado[0]['media'] : $dado['AlunoSimulado']['media'];
    } else {
        $id = $dado['AlunoSimuladoMateria']['aluno_simulado_id'];
        $nome = Materias::getNomeMateria($dado['AlunoSimuladoMateria']['materia']);
        $media = $dado['AlunoSimuladoMateria']['media'];
    }
    ?>
                [' <?= $nome ?>', <?= $media ?>],
<?php endforeach; ?>
        ]);

<?php
$title = 'Notas do simulado';
if (isset($evolucaoMaterias)) {
    $title = Materias::getNomeMateria($materia);
}

$widthGrafico = "630px";
$heigthGrafico = "320px";
if (isset($ranking)) {
    $title = 'Ranking de Alunos';
    $widthGrafico = "100%";
    $heigthGrafico = "500px";
}
?>
        var options = {
            title: '<?= $title; ?>',
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div' + <?= $id ?>));
        chart.draw(data, options);
    }
</script>

<div class="grafico" id="chart_div<?= $id ?>" style="width: <?= $widthGrafico ?>;background-color: white;height: <?= $heigthGrafico ?>;margin: 30px auto"></div>
