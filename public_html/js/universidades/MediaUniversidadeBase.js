var MediaUniversidadeBase = function() {

    this.ClasseUniversidade = '';

    this.load = function() {
        var self = this;
        var universidade_id = $('#SimuladoUniversidadeId').val();
        var classe = $('#universidade_' + universidade_id).val();
        self.setClasseUniversidade(classe);
        self.exibirMateriasPorUniversidade();
        $('#SimuladoUniversidadeId').change(function() {
            universidade_id = $(this).val();
            classe = $('#universidade_' + universidade_id).val();
            self.setClasseUniversidade(classe);
            self.exibirMateriasPorUniversidade();
        });
    };

    this.getMaterias = function() {
        return {
            1: 'INGLÊS',
            2: 'ESPANHOL',
            3: 'QUÍMICA',
            4: 'MATEMÁTICA',
            5: 'BIOLOGIA',
            6: 'FÍSICA',
            7: 'PORTUGUÊS',
            8: 'HISTÓRIA',
            9: 'LITERATURA',
            10: 'GEOGRAFIA',
            11: 'FILOSOFIA',
            12: 'SOCIOLOGIA',
            13: 'INTERPRETAÇÃO',
            14: 'REDAÇÃO'
        };

    };

    this.existeMateria = function(materia) {
        var materias = this.getMaterias();
        if (typeof materias[materia] !== 'undefined') {
            return true;
        }

        return false;
    };

    this.getNumeroQuestoes = function() {
        return 8;
    };

    this.setClasseUniversidade = function(classe) {
        this.ClasseUniversidade = classe;
    };

    this.getClasseUniversidade = function() {
        return this.ClasseUniversidade;
    };

    this.getObjUniversidade = function() {
        var classe = this.getClasseUniversidade();
        var objUniversidade;
        switch (classe) {
            case 'MediaUPF':
                objUniversidade = new MediaUPF();
                break;

            case 'MediaUnisc':
                objUniversidade = new MediaUnisc();
                break;

            case 'MediaImed':
                objUniversidade = new MediaImed();
                break;

            case 'MediaUFRGS':
                objUniversidade = new MediaUFRGS();
                break;

            case 'MediaACAFE':
                objUniversidade = new MediaACAFE();
                break;

            case 'MediaUCS':
                objUniversidade = new MediaUCS();
                break;

            default:
                objUniversidade = this;
                break;
        }

        return objUniversidade;
    };

    this.exibirMateriasPorUniversidade = function() {
        var materias = this.getMaterias();
        var objUniversidade = this.getObjUniversidade();
        var num_questoes = objUniversidade.getNumeroQuestoes();
        $.each(materias, function(key) {
            $('#materia' + key).show();
            if (typeof NumeroQuestoesDefault === "undefined") {
                $('#SimuladoNumeroQuestoes' + key + ' option[value="' + num_questoes + '"]').prop("selected", true).change();
            }

            if (!objUniversidade.existeMateria(key)) {
                $('#materia' + key).hide();
                if (typeof NumeroQuestoesDefault === "undefined") {
                    $('#SimuladoNumeroQuestoes' + key + ' option[value="0"]').prop("selected", true).change();
                }
            }

            if (typeof NumeroQuestoesDefault === "undefined") {
                if (num_questoes == 6) {//unisc
                    $('#SimuladoNumeroQuestoes11 option[value="3"]').prop("selected", true).change();//filosofia
                    $('#SimuladoNumeroQuestoes12 option[value="3"]').prop("selected", true).change();//sociologia
                }
            }
        });
    };


};

$(function() {
    var base = new MediaUniversidadeBase();
    base.load();

});