$(function () {
    $('#SimuladoExtensao').change(function () {
        $('#SimuladoSimuladoId').hide();
        if (this.checked) {
            $('#SimuladoSimuladoId').show();
        }
    });

    $(".materias").bind('change', function () {
        var k = $(this).attr('data-materia');
        var num_questoes = $('#SimuladoNumeroQuestoes' + k).val();
        $('#Gabarito' + k).html('');
        if (num_questoes != 0) {
            var gabarito = new Gabarito();
            var html = '';
            html += '<input type="hidden" name="data[MateriaSimulado][materia' + k + '][materia]" value="' + k + '" />';
            html += '<input type="hidden" name="data[MateriaSimulado][materia' + k + '][numero_questoes]" value="' + num_questoes + '" />';
            for (var i = 1; i <= num_questoes; i++) {
                html += 'Resposta Correta da Questão ' + i + '-';
                html += '<select id="RespostasOpcoes' + i + '" style="margin-right: 20px;" name="data[MateriaSimulado][materia' + k + '][Gabarito][' + i + '][alternativa_correta]">';
                var arrayOpcoes = gabarito.getOpcoesGabarito();
                for (var indice in arrayOpcoes) {
                    html += "<option value='" + arrayOpcoes[indice] + "'>" + arrayOpcoes[indice] + "</option>";
                }

                html += '</select>';
                html += '<input type="hidden" name="data[MateriaSimulado][materia' + k + '][Gabarito][' + i + '][num_questao]" value="' + i + '" />';

                html += '<input type="text" placeholder="Pergunta Questão ' + i + '" name="data[MateriaSimulado][materia' + k + '][Gabarito][' + i + '][pergunta]" />';
                html += '<br /><br />';
                for (var indice in arrayOpcoes) {
                    html += '<input type="text" placeholder="Resposta letra ' + arrayOpcoes[indice] + '" name="data[MateriaSimulado][materia' + k + '][Gabarito][' + i + '][resposta][' + arrayOpcoes[indice] + ']" />';
                }

                html += '<br /><br />';
                html += '<input type="checkbox" data-materia="' + k + '" data-questao="' + i + '" onclick="clicouBoxAnexarConteudos(this)" id="TemConteudoMateria' + k + 'Questao' + i + '" name="data[MateriaSimulado][materia' + k + '][Gabarito][' + i + '][tem_conteudos]" />';
                html += '<label for="TemConteudoMateria' + k + 'Questao' + i + '">Anexar Conteúdos para a Questão ' + i + '?</label>';

                html += '<div style="display:none" id="DivConteudosQuestao' + i + 'Materia' + k + '"></div>';
                html += '<br /><br />';
            }

            $('#Gabarito' + k).html(html);
        }
    });

});

function clicouBoxAnexarConteudos(elmnt) {
    var materia = $(elmnt).data('materia');
    var questao = $(elmnt).data('questao');
    $("#DivConteudosQuestao" + questao + "Materia" + materia).hide();

    if (elmnt.checked) {
        var html = '<div class="DivOpcoesConteudos">';
        html += '<input placeholder="Digite o código dos conteúdos" type="text" name="data[MateriaSimulado][materia' + materia + '][Gabarito][' + questao + '][conteudos_selecionados]" />';
        html += '<p>Para mais de um conteúdo, coloque uma vírgula. <br />Ex:cod1, cod2, cod3</p>';
        html += '</div>';
        $("#DivConteudosQuestao" + questao + "Materia" + materia).show().html(html);
    }
}