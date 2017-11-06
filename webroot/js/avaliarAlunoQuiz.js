var avaliarAlunoQuiz = {
    init: function () {
        this.getAlunosQueNaoForamAvaliados();
        $('#quiz-id').change(function () {
            avaliarAlunoQuiz.getAlunosQueNaoForamAvaliados();
        });
    },
    getAlunosQueNaoForamAvaliados: function () {
        var url = window.URL_BASE + 'quizzes/getAlunosQueNaoForamAvaliadosAjax?quizId=' + $('#quiz-id').val();
        var promise = $.getJSON(url);
        promise.done(function (data) {
            avaliarAlunoQuiz.carregarAlunos(data);
        });

        promise.fail(function () {
            alert('Erro na busca dos alunos!');
        });

    },
    carregarAlunos: function (alunos) {
        var optionsSelectAlunos = '';
        $.each(alunos, function (idAluno, alunoNome) {
            optionsSelectAlunos += '<option value="' + idAluno + '">' + alunoNome + '</option>';
        });

        $('#aluno-id').html(optionsSelectAlunos);

    }
};

$(function () {
    avaliarAlunoQuiz.init();
});