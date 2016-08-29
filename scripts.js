var ajeitaForm = function ( form, pos ) {
    form.css( {
        '-webkit-transform': 'translateX(' + pos + 'px' + ')',
        '-moz-transform'   : 'translateX(' + pos + 'px' + ')',
        '-ms-transform'    : 'translateX(' + pos + 'px' + ')',
        '-o-transform'     : 'translateX(' + pos + 'px' + ')',
        'transform'        : 'translateX(' + pos + 'px' + ')'
    } );

};

$( function () {
    var form = $( '#form-lamp' );

    $( '#foto' ).change( function () {
        ajeitaForm( form, -305 );
    } );

    form.submit( function ( e ) {
        e.preventDefault();

        // Email é válido?
        if ( !$( '#email' ).val().match( /^[a-z0-9\._-]+@[a-z0-9_-]+\.[a-z0-9\._-]+$/i ) ) {
            alert( 'Por favor, nos informe um email válido' );
            return false;
        }

        var wait = $( '#wait' );
        var url  = form.attr( 'action' );

        // Pegando todos os dados, incluindo arquivos
        var formData = new FormData( this );

        // Aguarde...
        wait.fadeIn();

        $.ajax( {
            url     : url,
            type    : 'POST',
            dataType: "JSON",

            // Dados essenciais para upload de arquivos
            data       : formData,
            cache      : false,
            contentType: false,
            processData: false,

            // Sucesso
            success: function ( dados ) {
                // Colocando mensagem de retorno
                var retorno = $( '#retorno' );
                retorno.html( dados.msg );

                // Mensagem é de erro?
                if ( dados.erro )
                    retorno.addClass( 'erro' );

                // Some com o aguarde
                wait.fadeOut();

                // Mostra mensagem de retorno
                ajeitaForm( form, -610 );

                console.log( dados.msg );
                console.log( dados.erro );
            },

            // Falha
            error: function ( retorno ) {
                console.error( retorno );
            }
        } );

    } );

} );
