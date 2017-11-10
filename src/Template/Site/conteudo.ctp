<script>
    $(function () {
        $("#JanelaExplicacaoGeral").dialog({autoOpen: false});

        $("#explicacaoConteudo").click(function () {
            $("#JanelaExplicacaoGeral").dialog({
                height: "auto",
                width: '85%',
                modal: true,
                autoOpen: true,
                position: {my: "center", at: "center", of: ".descricaoConteudo"}
            });
            return false;
        });
    });
</script>

<div class="conteudos view medium-12 columns content">
    <h3><?= $conteudo->nomeCompleto; ?></h3>
    <table id="menusExplicaocaoProximo" class="vertical-table">   
        <tr>
            <?php if ($ecaAluno == \App\Model\Table\AlunosTable::ECA_GLOBAL): ?>
                <td style="text-align: left;"><?= $this->Html->link('Pré-explicação', '#', ['id' => 'explicacaoConteudo']); ?></td>

            <div id="JanelaExplicacaoGeral" style="display: none;" title="Pré-explicação">
                <?= $this->Text->autoParagraph(h($conteudo->explicacao_geral)); ?>
            </div>
        <?php endif; ?>            
        <td><?= $this->Html->link('Próximo Conteúdo', '/site/proximo_conteudo/' . $conteudo->id); ?></td>            
        </tr>
    </table>
    <div class="row descricaoConteudo">
        <?= $this->Text->autoParagraph(h($conteudo->descricao)); ?>
    </div>
    <table class="vertical-table">   
        <tr>
            <td><?= $this->Html->image('/webroot/uploads/Conteudos/anexo_img/' . $conteudo->pasta . '/' . $conteudo->anexo_img) ?></td>
        </tr>
        <?php if (!empty($conteudo->anexo_doc)): ?>
            <tr>
                <td><?php echo $this->Html->link('Baixar Documento Auxiliar', '/site/download_doc/' . $conteudo->id); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td><?= $this->Html->link('Próximo Conteúdo', '/site/proximo_conteudo/' . $conteudo->id); ?></td> 
        </tr>
    </table>
</div>