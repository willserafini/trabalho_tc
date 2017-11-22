<?php $this->Html->script('loader', ['block' => true]); ?>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Quiz', 'Nota Final'],
            
            <?php foreach ($notasQuizzes as $notaQuiz) : ?>
                ['<?= $notaQuiz->quiz->nome ?>',  <?= $notaQuiz->nota_final ?>],
            <?php endforeach; ?>
            
        ]);

        var options = {
            title: 'Desempenho nas Atividades',
            hAxis: {title: 'Atividades', titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<div id="chart_div" style="width: 100%; min-height: 500px; height: auto;"></div>