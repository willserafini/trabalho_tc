<script>
    $(function () {
        $('form').submit(function () {
            $('.submit').html('<p>Aguarde, calculando nota...</p>');
        })
    });
</script>

<div class="columns">
    <h3><?= $quiz->nome ?></h3>

    <table class="vertical-table">   
        <tr>
            <td><?= $this->Html->link('Próximo Conteúdo', '/site/quiz_proximo_conteudo/' . $quiz->conteudo_id); ?></td>            
        </tr>
    </table>

    <div class="clearfix"></div>
    <br />

    <?= $this->Form->create(); ?>
    <div class="panel">
        <?php
        foreach ($quizPerguntas as $index => $pergunta) :
            $opcoesResposta = json_decode($pergunta->opcoes_resposta_objetiva, true);
            ?>
            <p>Pergunta <?= $pergunta->num_questao ?>. <?= $pergunta->questao ?></p>
            <?= $this->Form->hidden('AlunoResposta.' . $index . '.id', ['value' => $pergunta->aluno_resposta_id]); ?>
            <?= $this->Form->hidden('AlunoResposta.' . $index . '.quiz_id', ['value' => $pergunta->quiz_id]); ?>
            <?= $this->Form->hidden('AlunoResposta.' . $index . '.pergunta_id', ['value' => $pergunta->id]); ?>
            <div class="input radio">
                <input type="hidden" name="AlunoResposta[<?= $index ?>][resposta_selecionada]" value="">
                <?php
                foreach ($opcoesResposta as $key => $opcaoResposta) :
                    if (empty($opcaoResposta)) {
                        continue;
                    }
                    ?>
                    <label class="labelOpcaoResposta" for="alunoresposta-<?= $index ?>-resposta-selecionada-<?= $key ?>">
                        <input type="radio" name="AlunoResposta[<?= $index ?>][resposta_selecionada]" value="<?= $key ?>" id="alunoresposta-<?= $index ?>-resposta-selecionada-<?= $key ?>" required="required">
                        Letra <?= $key ?>. <?= $opcaoResposta ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <br />
        <?php endforeach; ?>
        <?= $this->Form->submit('Enviar Respostas', array('class' => 'button')); ?>
        <?= $this->Form->end(); ?>
    </div>


</div>