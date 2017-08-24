var CarregarAlunosPorEmpresa = {
    init: function () {
        this.carregarAlunos();
        $('#RelatorioEmpresaId').change(function (e) {
            CarregarAlunosPorEmpresa.carregarAlunos();
        });
    },
    carregarAlunos: function () {
        var empresaId = $('#RelatorioEmpresaId').val();
        $('#RelatorioAlunoId').html('<option value="">Carregando...</option>');
        var params = {
            empresaId: empresaId
        };
        var url = window.URL_BASE + 'alunos/getAlunosByEmpresaIdAjax.json';
        var promise = $.getJSON(url, params);
        promise.done(function (data) {
            CarregarAlunosPorEmpresa.populaSelectAlunos(data);
        }).fail(function () {
            alert('Não foi possível carregar os alunos dessa empresa!');
        });

    },
    populaSelectAlunos: function (alunos) {
        var html = '';
        if (typeof OpcaoTodosAlunos === "undefined" || OpcaoTodosAlunos == true) {
            html += '<option value="">Todos</option>';
        }
        
        for (i in alunos) {            
            var aluno = alunos[i];
            html += '<option value="' + aluno.Aluno.id + '">' + aluno.Aluno.nome + '</option>';
        }

        if (alunos.length <= 0) {
            html = '<option value="">Nenhum aluno encontrado!</option>';
        }

        $('#RelatorioAlunoId').html(html);
    }
};

$(function () {
    CarregarAlunosPorEmpresa.init();
});