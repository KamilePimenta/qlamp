$(
    function () {
        $( '#foto' ).change(
            function () {
                $( '#qLamp form' ).css(
                    {
                        '-webkit-transform': 'translateX(' + - 305 + 'px' + ')',
                        '-moz-transform': 'translateX(' + - 305 + 'px' + ')',
                        '-ms-transform': 'translateX(' + - 305 + 'px' + ')',
                        '-o-transform': 'translateX(' + - 305 + 'px' + ')',
                        'transform': 'translateX(' + - 305 + 'px' + ')'
                    }
                );
            }
        );

        $( '#qLamp .enviar' ).click(
            function () {
                if ( $( 'input#email' ).text() != '' )
                    $( '#qLamp form' ).css(
                        {
                            '-webkit-transform': 'translateX(' + - 610 + 'px' + ')',
                            '-moz-transform': 'translateX(' + - 610 + 'px' + ')',
                            '-ms-transform': 'translateX(' + - 610 + 'px' + ')',
                            '-o-transform': 'translateX(' + - 610 + 'px' + ')',
                            'transform': 'translateX(' + - 610 + 'px' + ')'
                        }
                    );
                else
                    alert( 'Preencha o email' );
            }
        );

        var form = $( '#form-lamp' );
        form.submit(
            function ( e ) {
                e.preventDefault();

                var url = form.attr( 'action' );
                var formData = new formData( this );

                $.post(
                    url, formData, function ( dados ) {
                        console.log( dados.erro );
                        console.log( dados.msg );
                    }, 'JSON'
                );

                /*$.ajax({
                           url: url,
                           type: 'POST',
                           data: formData,
                           success: function (dados) {
                               console.log( dados.msg );
                           },
                           error: function ( dados ) {
                               console.log( dados.erro );
                           },
                           cache: false
                       });*/

            }
        );

    }
);