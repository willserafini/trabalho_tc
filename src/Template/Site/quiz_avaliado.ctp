<div class="columns">
    <h3><?= $quizNome ?></h3>    
    <div class="clearfix"></div>
    <br />
    <div class="panel">
        <?php
        foreach ($quizPerguntas['perguntas'] as $index => $pergunta) :
            $opcoesResposta = json_decode($pergunta->opcoes_resposta_objetiva, true);
            $respostaCorreta = $pergunta->resposta_correta;
            $respostaSelecionadaAluno = $pergunta->respostaSelecionada;
            ?>
            <p>Pergunta <?= $pergunta->num_questao ?>. <?= $pergunta->questao ?></p>
            <div class="input radio">
                <?php
                foreach ($opcoesResposta as $key => $opcaoResposta) :
                    if (empty($opcaoResposta)) {
                        continue;
                    }

                    $checked = '';
                    $label = 'labelOpcaoResposta';
                    if ($key == $respostaSelecionadaAluno) {
                        $label = 'label-danger';
                        $checked = 'checked="checked"';
                    }

                    if ($key == $respostaCorreta) {
                        $label = 'label-success';
                    }
                    ?>


                    <label class="<?= $label ?>" for="alunoresposta-<?= $index ?>-resposta-selecionada-<?= $key ?>">
                        Letra <?= $key ?>. <?= $opcaoResposta ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <?= $this->Form->control('Conf.' . $index . '.nota', ['value' => $pergunta['nota'], 'readonly' => true]); ?>
            <?= $this->Form->control('Conf.' . $index . '.obs', ['value' => $pergunta['obs'], 'readonly' => true]); ?>
            <br />
        <?php endforeach; ?>

        <?= $this->Form->control('Conf.nota_final', ['value' => $quizPerguntas['notaFinal'], 'readonly' => true]); ?>
    </div>
</div>