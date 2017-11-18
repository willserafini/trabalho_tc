<style type="text/css">
    code {
        padding: .2rem .4rem;
        font-size: 90%;
        color: #bd4147;
        background-color: #f7f7f9;
        border-radius: .25rem;
        font-family: Menlo,Monaco,Consolas,"Courier New",monospace;
        border-color: #dfdfdf;
        border-style: solid;
        border-width: 1px;
        font-weight: normal;
    }
    .label-success {
        background-color: #5cb85c;
    }
    .label-danger {
        background-color: #d9534f;
    }
    .labelOpcaoResposta {
        border: 1px solid black;
    }
    label {
        display: inline-block;
    }
    .checkbox label, .radio label {
        padding-left: 1.25rem;
        margin-bottom: 0;
        font-weight: 400;
        cursor: pointer;
    }
</style>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Quizzes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="avaliar-quiz form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Acertos/Erros nas Atividades') ?></legend>
        <?php
        echo $this->Form->control('quiz_id', ['options' => $quizzes]);
        echo $this->Form->control('aluno_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Buscar')) ?>
    <?= $this->Form->end() ?>
</div>

<?php if (isset($quizPerguntas)) : ?>
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
<?php endif; ?>

