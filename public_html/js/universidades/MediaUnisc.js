var MediaUnisc = function() {

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
        return 6;
    };


};