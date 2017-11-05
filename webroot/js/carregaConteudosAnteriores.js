var carregaConteudosAnteriores = {
    init: function () {
        this.getConteudosAnteriores();
        $('#conteudo-id').change(function () {
            carregaConteudosAnteriores.getConteudosAnteriores();
        });
    },
    getConteudosAnteriores: function () {
        var url = window.URL_BASE + 'conteudos/getConteudosAnterioresAjax?conteudoPaiId=' + $('#conteudo-id').val();
        var promise = $.getJSON(url);
        promise.done(function (data) {
            carregaConteudosAnteriores.carregarConteudoAnteriores(data);
        });

        promise.fail(function () {
            alert('Erro na busca dos conteúdos anteriores!');
        });

    },
    carregarConteudoAnteriores: function (conteudoAnteriores) {
        var optionsSelectConteudoAnterior = '';
        $.each(conteudoAnteriores, function (idConteudo, conteudoNome) {
            optionsSelectConteudoAnterior += '<option value="' + idConteudo + '">' + conteudoNome + '</option>';
        });

        var valorDefault = $('#conteudo-anterior-id').data('default');
        $('#conteudo-anterior-id').html(optionsSelectConteudoAnterior);
        if (typeof valorDefault !== 'undefined') {
            $('#conteudo-anterior-id').val(valorDefault);
        }

    }
};

$(function () {
    carregaConteudosAnteriores.init();
});