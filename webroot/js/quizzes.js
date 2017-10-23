var Quizzes = {
    indexPergunta: 1,
    init: function () {
        $('.addPergunta').click(function () {
            $(Quizzes.getDivPerguntaPadrao()).clone().appendTo(".perguntas_quizzes");
            return false;
        });
    },
    getDivPerguntaPadrao: function () {
        var index = this.indexPergunta;
        var div = '<div class="pergunta_padrao">\n\
                        <div class="input select">\n\
                        <label for="pergunta-' + index + '-tipo">Tipo</label>\n\
                        <select name="perguntas[' + index + '][tipo]" id="pergunta-' + index + '-tipo">\n\
                        <option value="1">Dissertativa</option>\n\
                        </select>\n\
                        </div>\n\
                        <div class="input text">\n\
                        <label for="pergunta-' + index + '-num-questao">Num Questao</label>\n\
                        <input type="text" name="perguntas[' + index + '][num_questao]" id="pergunta-' + index + '-num-questao" value="' + (index + 1) + '"/>\n\
                        </div>\n\
                        <div class="input text">\n\
                        <label for="pergunta-' + index + '-questao">Questao</label>\n\
                        <input type="text" name="perguntas[' + index + '][questao]" id="pergunta-' + index + '-questao"/>\n\
                        </div>\n\
                        <br />\n\
                    </div>';
        this.indexPergunta ++;
        return div;
    }
};

$(function () {
    Quizzes.init();
});