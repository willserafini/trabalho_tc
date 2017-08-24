<table style="width:100%">
    <tr>
        <th>Horário</th>
        <?php foreach (Util::getDiasDaSemana() as $dia) : ?>
            <th><?= $dia; ?></th>
        <?php endforeach; ?>                
    </tr>

    <?php for($i = 1; $i <= 10; $i++) :
        $linha = 'Linha' . $i;        
    ?>
    <tr>
        <th>
            <?php 
                $valor = '';
                if(isset($this->request->data['HorarioOpcional'])) {
                    $valor = $this->request->data['HorarioOpcional']->$linha->coluna_horario;
                }
                
                echo $this->Form->input('HorarioOpcional.Linha' . $i .'.coluna_horario', ['label' => false, 'value' => $valor]); 
            ?>
        </th>
        
        <?php foreach (Util::getDiasDaSemana() as $key => $dia) : ?>
            <th>
                <?php 
                    $valor = '';
                    if(isset($this->request->data['HorarioOpcional'])) {
                        $campo = 'coluna_' . $key;
                        $valor = $this->request->data['HorarioOpcional']->$linha->$campo;
                    }
                    
                    echo $this->Form->input('HorarioOpcional.Linha' . $i .'.coluna_' . $key, ['label' => false, 'value' => $valor]); 
                ?>
            </th>
        <?php endforeach; ?> 
    </tr>
    <?php endfor; ?>

</table>