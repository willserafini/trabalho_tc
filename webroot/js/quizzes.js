var Quizzes = {
    indexPergunta: 1,
    init: function () {
        $('.addPergunta').click(function () {
            $(Quizzes.getDivPerguntaPadrao()).clone().appendTo(".perguntas_quizzes");
            tinymce.init({ selector:'textarea' });
            return false;
        });
        tinymce.init({ selector:'textarea' });
    },
    getDivPerguntaPadrao: function () {
        var index = this.indexPergunta;
        var div = ' <div class="pergunta_padrao">\n\
                        <div class="colunas-3">\n\
                            <div class="input select required">\n\
                                <label for="pergunta-' + index + '-tipo">Tipo</label>\n\
                                <select required="required" name="perguntas[' + index + '][tipo]" id="pergunta-' + index + '-tipo">\n\
                                    <option value="2">Objetiva</option>\n\
                                </select>\n\
                            </div>\n\
                            <div class="input text required">\n\
                                <label for="pergunta-' + index + '-num-questao">Nº da Questão</label>\n\
                                <input required="required" type="text" name="perguntas[' + index + '][num_questao]" id="pergunta-' + index + '-num-questao" value="' + (index + 1) + '"/>\n\
                            </div>\n\
                            <div class="input select required">\n\
                                <label for="perguntas-' + index + '-resposta-correta">Resposta Correta</label>\n\
                                <select name="perguntas[' + index + '][resposta_correta]" required="required" id="perguntas-' + index + '-resposta-correta">\n\
                                    <option value="A">A</option>\n\
                                    <option value="B">B</option>\n\
                                    <option value="C">C</option>\n\
                                    <option value="D">D</option>\n\
                                    <option value="E">E</option>\n\
                                </select>\n\
                            </div>\n\
                        </div>\n\
                        <div class="input textarea required">\n\
                            <label for="pergunta-' + index + '-questao">Questão</label>\n\
                            <textarea name="perguntas[' + index + '][questao]" id="perguntas-' + index + '-questao" rows="20"></textarea>\n\
                        </div>\n\
                        <div class="opcoesLetra colunas-2">\n\
                            <div class="input textarea">\n\
                            <label for="perguntas-' + index + '-opcoes_resposta_objetiva-a">Opção A</label>\n\
                            <textarea name="perguntas[' + index + '][opcoes_resposta_objetiva][A]" rows="5" id="perguntas-' + index + '-opcoes_resposta_objetiva-a"></textarea>\n\
                            </div>\n\
                            <div class="input textarea">\n\
                            <label for="perguntas-' + index + '-opcoes_resposta_objetiva-b">Opção B</label>\n\
                            <textarea name="perguntas[' + index + '][opcoes_resposta_objetiva][B]" rows="5" id="perguntas-' + index + '-opcoes_resposta_objetiva-b"></textarea>\n\
                            </div>\n\
                            <div class="input textarea">\n\
                            <label for="perguntas-' + index + '-opcoes_resposta_objetiva-c">Opção C</label>\n\
                            <textarea name="perguntas[' + index + '][opcoes_resposta_objetiva][C]" rows="5" id="perguntas-' + index + '-opcoes_resposta_objetiva-c"></textarea>\n\
                            </div>\n\
                            <div class="input textarea">\n\
                            <label for="perguntas-' + index + '-opcoes_resposta_objetiva-d">Opção D</label>\n\
                            <textarea name="perguntas[' + index + '][opcoes_resposta_objetiva][D]" rows="5" id="perguntas-' + index + '-opcoes_resposta_objetiva-d"></textarea>\n\
                            </div>\n\
                            <div class="input textarea">\n\
                            <label for="perguntas-' + index + '-opcoes_resposta_objetiva-e">Opção E</label>\n\
                            <textarea name="perguntas[' + index + '][opcoes_resposta_objetiva][E]" rows="5" id="perguntas-' + index + '-opcoes_resposta_objetiva-e"></textarea>\n\
                            </div>\n\
                        </div>\n\
                    </div>\n\
                    <div class="clear"></div>\n\
                    <br />';
        this.indexPergunta ++;
        return div;
    }
};

$(function () {
    Quizzes.init();
});