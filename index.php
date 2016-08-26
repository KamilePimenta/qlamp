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
            <div class="principal" style="display: none">
                <p class="first"><span class="big">Qual é</span> a lâmpada?</p>
                <p>descubra a lâmpada ideal para a sua casa</p>
                <form class="imagem">
                    <input class="foto" type="file" id="foto" name="foto">
                    <label class="text" for="foto">Foto da Lâmpada</label>
                </form>
                <img class="img logo" src="https://www.aiha.com.br/img/arquivos/layout/qlamp/logo.png" alt="Logo AIHA"/>
            </div>
            <div class="msg" style="display: none">
                <form class="mensagem">
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
                        <textarea id="msg" name="msg" placeholder="Informe qual tipo de lâmpada que você precisa"></textarea>
                    </div>
                    <button type="submit">Enviar</button>
                </form>
            </div>
            <div class="pronto">
                <p>
                    <span class="dif">Pronto!</span>
                    Sua solicitação foi enviada!<br/>
                    Aguarde nosso contato.
                </p>
                <a class="voltar" href="http://www.aiha.com.br/">voltar para loja</a>
            </div>
        </div>
    </div>
</body>
</html>