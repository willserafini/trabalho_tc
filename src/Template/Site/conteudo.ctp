<div class="conteudos view large-9 medium-8 columns content">
    <h3><?= $conteudo->nome; ?></h3>
    <table class="vertical-table">        
        <tr>
            <th scope="row">Descrição do Conteúdo</th>
            <td><?= $conteudo->descricao; ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Anexo Img') ?></th>
            <td><?= $conteudo->anexo_img ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Anexo Doc') ?></th>
            <td><?= $conteudo->anexo_doc ?></td>
        </tr>
    </table>
</div>