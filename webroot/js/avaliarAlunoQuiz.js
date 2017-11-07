var avaliarAlunoQuiz = {
    init: function () {
        this.getAlunosQueNaoForamAvaliados();
        $('#quiz-id').change(function () {
            avaliarAlunoQuiz.getAlunosQueNaoForamAvaliados();
        });
        $('#CalcularNotaFinal').on('click', function(event) {
            event.preventDefault();
            avaliarAlunoQuiz.calcularNotaFinal();            
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

    },
    calcularNotaFinal: function () {
        var notaFinal = 0;
        $('.notaResposta').each(function() {
            notaFinal += this.value * 1;
        });
        
        $('#alunoquiz-nota-final').val(notaFinal);
    }
};

$(function () {
    avaliarAlunoQuiz.init();
});