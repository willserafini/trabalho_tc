var OW_BUSCA_TIPO_COMECA_COM = 2;

$(function() {
    $('#letras a').click(function(event) {
        var letra = $(event.target).text();
        $('#OwBusca0Tipo').val(OW_BUSCA_TIPO_COMECA_COM);
        $('#OwBusca0Valor').val(letra);
        $("#OwCamposBusca form").submit();
        event.preventDefault();
    })
});