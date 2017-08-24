var CarregarListasPorUniversidade = {
    init: function () {
        this.carregarListas();
        $('#RelatorioUniversidadeId').change(function (e) {
            CarregarListasPorUniversidade.carregarListas();
        });
    },
    carregarListas: function () {
        var universidadeId = $('#RelatorioUniversidadeId').val();
        $('#RelatorioSimuladoId').html('<option value="">Carregando...</option>');
        var params = {
            universidadeId: universidadeId
        };
        var url = window.URL_BASE + 'simulados/getSimuladosByUniversidadeIdAjax.json';
        var promise = $.getJSON(url, params);
        promise.done(function (data) {
            CarregarListasPorUniversidade.populaSelectSimulados(data);
        }).fail(function () {
            alert('Não foi possível carregar as listas dessa universidade!');
        });

    },
    populaSelectSimulados: function (simulados) {
        var html = '';
        if (typeof OpcaoTodasListas === "undefined" || OpcaoTodasListas == true) {
            html += '<option value="">Todas</option>';
        }
        
        for (i in simulados) {
            html += '<option value="' + i + '">' + simulados[i] + '</option>';
        }

        if (simulados.length <= 0) {
            html = '<option value="">Nenhuma lista encontrada!</option>';
        }

        $('#RelatorioSimuladoId').html(html);
    }
};

$(function () {
    CarregarListasPorUniversidade.init();
});