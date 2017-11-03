<div class="conteudos view large-9 medium-8 columns content">
    <h3><?= $conteudo->nomeCompleto; ?></h3>
    <table class="vertical-table">   
        <tr>
            <td><?= $this->Html->link('Próximo Conteúdo', '/site/proximo_conteudo/' . $conteudo->id); ?></td>            
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Descricao') ?></h4>
        <?= $this->Text->autoParagraph(h($conteudo->descricao)); ?>
    </div>
    <table class="vertical-table">   
        <tr>
            <td><?= $this->Html->image('/webroot/uploads/Conteudos/anexo_img/' . $conteudo->pasta . '/' . $conteudo->anexo_img, array('width' => 150)) ?></td>
        </tr>
        <?php if (!empty($conteudo->anexo_doc)): ?>
            <tr>
                <td><?php echo $this->Html->link('Documento Auxiliar', '/site/download_doc/' . $conteudo->id); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td><?= $this->Html->link('Próximo Conteúdo', '/site/proximo_conteudo/' . $conteudo->id); ?></td> 
        </tr>
    </table>
</div>