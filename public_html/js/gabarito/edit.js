$(function () {
    var simulado_id = $('#SimuladoId').val();
    $.ajax({
        type: 'POST',
        url: URL_BASE + 'simulados/getQuestoesEscolhidas',
        data: 'data[Simulado][simulado_id]=' + simulado_id,
        success: function (data) {
            this.data = JSON.parse(data);
            var gabarito = new Gabarito();
            for (var i in this.data) {
                var materia = this.data[i].MateriaSimulado.materia;
                var num_questoes = this.data[i].MateriaSimulado.numero_questoes;
                var GabaritoMateria = this.data[i].Gabarito;
                $('.materias').each(function () {
                    if ($(this).attr('data-materia') == materia) {
                        $(this).val(num_questoes);
                        var html = '';
                        html += '<input type="hidden" name="data[MateriaSimulado][materia' + materia + '][materia]" value="' + materia + '" />';
                        html += '<input type="hidden" name="data[MateriaSimulado][materia' + materia + '][numero_questoes]" value="' + num_questoes + '" />';
                        for (var key in GabaritoMateria) {
                            var questao = GabaritoMateria[key].num_questao;
                                var arrayOpcoes = gabarito.getOpcoesGabarito();
                                var alter_correta = GabaritoMateria[key].alternativa_correta;
                                html += 'Resposta Correta da Questão ' + questao + '-';
                                html += '<select id="RespostasOpcoes_' + materia + '_' + questao + '" style="margin-right: 20px;" name="data[MateriaSimulado][materia' + materia + '][Gabarito][' + questao + '][alternativa_correta]">';
                                for (var indice in arrayOpcoes) {
                                    var selected = '';
                                    if (arrayOpcoes[indice] == alter_correta) {
                                        selected = 'selected';
                                    }

                                    html += "<option " + selected + " value='" + arrayOpcoes[indice] + "'>" + arrayOpcoes[indice] + "</option>";
                                }

                                html += '</select>';
                                html += '<input type="hidden" name="data[MateriaSimulado][materia' + materia + '][Gabarito][' + questao + '][num_questao]" value="' + questao + '" />';

                                html += '<input type="text" placeholder="Pergunta Questão ' + questao + '" name="data[MateriaSimulado][materia' + materia + '][Gabarito][' + questao + '][pergunta]" value="' + GabaritoMateria[key].pergunta + '" />';
                                html += '<br /><br />';

                                var arrayRespostas = [];
                                if (GabaritoMateria[key].respostas.length !== 0) {
                                    arrayRespostas = JSON.parse(GabaritoMateria[key].respostas);
                                }

                                for (var indice in arrayOpcoes) {
                                    var letraReferencia = arrayOpcoes[indice];
                                    var respostaLetra = "";
                                    if (arrayRespostas.length !== 0) {
                                        respostaLetra = arrayRespostas[letraReferencia];
                                    }
                                    html += '<input type="text" placeholder="Resposta letra ' + arrayOpcoes[indice] + '" name="data[MateriaSimulado][materia' + materia + '][Gabarito][' + questao + '][resposta][' + arrayOpcoes[indice] + ']" value="' + respostaLetra + '" />';
                                }

                                html += '<br /><br />';

                                var isChecked = '';
                                var opcaoDisplayDiv = 'none';
                                if (!jQuery.isEmptyObject(GabaritoMateria[key].conteudos_selecionados)) {
                                    isChecked = 'checked="checked"';
                                    opcaoDisplayDiv = 'block';
                                }

                                html += '<input type="checkbox" ' + isChecked + ' data-materia="' + materia + '" data-questao="' + questao + '" onclick="clicouBoxAnexarConteudos(this)" id="TemConteudoMateria' + materia + 'Questao' + questao + '" name="data[MateriaSimulado][materia' + materia + '][Gabarito][' + questao + '][tem_conteudos]" />';
                                html += '<label for="TemConteudoMateria' + materia + 'Questao' + questao + '">Anexar Conteúdos para a Questão ' + questao + '?</label>';

                                html += '<div style="display:' + opcaoDisplayDiv + '" id="DivConteudosQuestao' + questao + 'Materia' + materia + '">';
                                if (isChecked) {                                    
                                    html += getHtmlConteudosSelecionados(GabaritoMateria[key].conteudos_selecionados, materia, questao);
                                }
                                
                                html += '</div>';
                                html += '<br /><br />';
                        }

                        $('#Gabarito' + materia).html(html);

                    }
                });
            }
        }
    });
});

function getHtmlConteudosSelecionados(conteudosSelecionados, materia, questao) {
    var nomeConteudosSelecionados = '';
    var ultimoElemento = conteudosSelecionados[conteudosSelecionados.length-1];
    $.each(conteudosSelecionados, function (index, conteudo) {
        nomeConteudosSelecionados += conteudo.Conteudo.codigo;        
        if(conteudo != ultimoElemento) {
            nomeConteudosSelecionados += ', ';
        }
    });

    var html = '<div class="DivOpcoesConteudos">';
    html += '<input value="' + nomeConteudosSelecionados + '" placeholder="Digite o código dos conteúdos" type="text" name="data[MateriaSimulado][materia' + materia + '][Gabarito][' + questao + '][conteudos_selecionados]" />';
    html += '<p>Para mais de um conteúdo, coloque uma vírgula. <br />Ex:cod1, cod2, cod3</p>';
    html += '</div>';

    return html;
}