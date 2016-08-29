/**
 * Muda posição do formulário para próxima tela
 * @param form Formulário (jQuery)
 * @param pos Posição que deve ficar
 */
var ajeitaForm = function ( form, pos ) {
    form.css( {
        '-webkit-transform': 'translateX(' + pos + 'px)',
        '-moz-transform'   : 'translateX(' + pos + 'px)',
        '-ms-transform'    : 'translateX(' + pos + 'px)',
        '-o-transform'     : 'translateX(' + pos + 'px)',
        'transform'        : 'translateX(' + pos + 'px)'
    } );

};

/**
 * Iniciando documento
 */
$( function () {

    // Formulário e botão voltar
    var form           = $( '#form-lamp' );
    var btnVoltar      = form.find( '.voltar' ).eq( 0 );
    var btnVoltarTexto = btnVoltar.html();

    // Houve escolha de foto?
    $( '#foto' ).change( function () {
        // Próxima tela
        ajeitaForm( form, -305 );
    } );

    // Formulário foi submetido?
    form.submit( function ( e ) {
        e.preventDefault();

        // Email é válido?
        if ( !$( '#email' ).val().match( /^[a-z0-9\._-]+@[a-z0-9_-]+\.[a-z0-9\._-]+$/i ) ) {
            alert( 'Por favor, nos informe um email válido' );
            return false;
        }

        // Pegando elementos de espera e url do form
        var wait = $( '#wait' );
        var url  = form.attr( 'action' );

        // Pegando todos os dados, incluindo arquivo, do form
        var formData = new FormData( this );

        // Aguarde...
        wait.fadeIn();

        // Enviando dados
        $.ajax( {
            url     : url,
            type    : 'POST',
            dataType: "JSON",

            // Dados essenciais para upload de arquivos
            data       : formData,
            cache      : false,
            contentType: false,
            processData: false,

            // Barra de progresso
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                // Avalia se tem suporte a propriedade upload
                if ( myXhr.upload ) {
                    myXhr.upload.addEventListener( 'progress', function ( progress ) {
                        // Pega o percentual de envio
                        // progress.loaded = quanto já foi enviado (bytes)
                        // progress.total = tamanho do arquivo (bytes)
                        var percentual = Math.round( progress.loaded / progress.total * 100 ) + '%';
                        wait.html( 'Enviando... (' + percentual + ')' );
                    }, false );
                }
                return myXhr;
            },

            // Sucesso
            success: function ( dados ) {
                // Colocando mensagem de retorno
                var retorno = $( '#retorno' );
                retorno.html( dados.msg.replace( /[\n\r]+/ig, '<br>' ) );

                // Mensagem é de erro?
                if ( dados.erro ) {
                    // Coloca classe de erro na div de retorno
                    retorno.addClass( 'erro' );
                    // Altera o botão de voltar para que leve o cliente pra tela inicial
                    btnVoltar
                        .html( 'Enviar outra Foto' )
                        .unbind( 'click' )
                        .bind( 'click', function ( e ) {
                            e.preventDefault();
                            ajeitaForm( form, 0 );
                        } );
                } else
                // Mantém o obtão voltar como original
                    btnVoltar
                        .html( btnVoltarTexto )
                        .unbind( 'click' );

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
