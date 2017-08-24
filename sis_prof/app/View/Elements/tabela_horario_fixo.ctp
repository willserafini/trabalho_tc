<table style="width:100%">
    <tr>
        <th></th>
        <?php foreach (Util::getDiasDaSemana() as $dia) : ?>
            <th><?= $dia; ?></th>
        <?php endforeach; ?>                
    </tr>
    <tr>
        <th>Manhã</th>
        <?php foreach (Util::getDiasDaSemana() as $key => $dia) : ?>
            <th>
                <?php
                    $valor = '';
                    if(isset($this->request->data['HorarioFixo'])) {
                        $campo = 'campo_' . $key;
                        $valor = $this->request->data['HorarioFixo']->LinhaManha->$campo;
                    }
                    
                    echo $this->Form->input('HorarioFixo.LinhaManha.campo_' . $key, ['label' => false, 'value' => $valor]); 
                ?>
            </th>                    
        <?php endforeach; ?> 
    </tr>
    <tr>
        <th>Tarde (até 16:50)</th>
        <?php foreach (Util::getDiasDaSemana() as $key => $dia) : ?>
            <th>
                <?php 
                    $valor = '';
                    if(isset($this->request->data['HorarioFixo'])) {
                        $campo = 'campo_' . $key;
                        $valor = $this->request->data['HorarioFixo']->LinhaTarde->$campo;
                    }
                    
                    echo $this->Form->input('HorarioFixo.LinhaTarde.campo_' . $key, ['label' => false, 'value' => $valor]); 
                ?>
            </th>                    
        <?php endforeach; ?> 
    </tr>
</table>