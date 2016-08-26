<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Qual é a Lâmpada?</title>
        <link href="estilo.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="qLamp">
            <div class="content">
                <form action="enviadados.php" class="imagem" enctype="multipart/form-data" method="post">
                    <div class="principal">
                        <p class="first"><span class="big">Qual é</span> a lâmpada?</p>
                        <p>descubra a lâmpada ideal para a sua casa</p>
                        <div class="imagem">
                            <input class="foto" type="file" id="foto" name="foto">
                            <label class="text" for="foto">Foto da Lâmpada</label>
                        </div>
                        <img class="img logo" src="img/logo.png"
                             alt="Logo AIHA" />
                    </div>
                    <div class="msg">
                        <div class="campo">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome">
                        </div>
                        <div class="campo">
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email">
                        </div>
                        <div class="campo">
                            <label for="msg">Mensagem:</label>
                            <textarea id="msg" name="msg"
                                      placeholder="Informe qual tipo de lâmpada que você precisa"></textarea>
                        </div>
                        <button type="submit">Enviar</button>
                    </div>
                    <div class="pronto">
                        <p>
                            <span class="dif">Pronto!</span>
                            Sua solicitação foi enviada!<br />
                            Aguarde nosso contato.
                        </p>
                        <a class="voltar" href="http://www.aiha.com.br/">voltar para loja</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>