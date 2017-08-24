var MediaUCS = function() {

    this.getMaterias = function() {
        return {
            1: 'INGLÊS',
            2: 'ESPANHOL',
            3: 'QUÍMICA',
            5: 'BIOLOGIA',
            7: 'PORTUGUÊS',
            13: 'CONHECIMENTOS_GERAIS',
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
        return 10;
    };


};