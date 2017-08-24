<?php echo $this->element('scripts_universidades'); ?>
<?php
foreach (Materias::getMaterias() as $k => $materia) {
    echo '<div id="materia' . $k . '"><br />';
    echo '<strong>' . $materia . '</strong>';
    $options = Materias::getNumQuestoes();
    $label = 'Número de Questões';
    $default = '';
    if ($k == Materias::REDACAO) {
        $options = [1 => 'Sim', 0 => 'Não'];
        $label = false;
        $default = 0;
    }

    echo $this->Form->input('numero_questoes' . $k, array('label' => $label, 'options' => $options, 'default' => $default, 'data-materia' => $k, 'class' => 'materias'));
    if ($k != Materias::REDACAO) {
        echo '<div style="width: 500px;" class="gabaritos" id="Gabarito' . $k . '"></div> <br />';
    }

    echo '</div>';
}
?>