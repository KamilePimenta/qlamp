<?php
require_once 'Saida.php';

if (! isset($_FILES[ 'foto' ])) {
    Saida::json('Acesso Negado', true);
}

$foto = $_FILES[ 'foto' ];
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$msg = filter_input(INPUT_POST, 'msg');

// Verificando email
if (empty($email)) {
    Saida::json('Digite um email válido', true);
}

// Verificando imagem
if (! isset($foto[ 'tmp_name' ]) || empty($foto[ 'tmp_name' ]) || ! preg_match('/image/i', $foto[ 'type' ])) {
    Saida::json('Envie-nos uma foto do ambiente para que possamos indicar a melhor lâmpada para você', true);
}

// Tentando mover foto
$fileContents = file_get_contents($foto[ 'tmp_name' ]);
$mime = $foto[ 'type' ];
$img = 'data: ' . $mime . ';base64,' . base64_encode($fileContents);

// Pegando o email da loja
require_once '../config/conecta.class.php';
$pdo = new Conecta();
$sacLoja = $pdo->execute('SELECT CON_EMAIL_LOJA FROM config', true)->CON_EMAIL_LOJA;

// Montando email
$mensagem = "<html><body>
    <p>Olá, gostaria de saber qual a melhor lâmpada para meu ambiente.</p>
    <p>
        <strong>Nome: </strong> $nome<br>
        <strong>Email:</strong> $email<br>
        <strong>Mensagem:</strong> $msg
    </p>
    <p><strong>Foto</strong></p>
    <img src='$img' alt='Imagem Ambiente' style='max-width: 100%; display: block;'>
</body></html>";

// Configurando e enviando email:
$headers = "MIME-Version: 1.1" . PHP_EOL;
$headers .= "Content-type: text/html; charset=utf-8" . PHP_EOL;
$headers .= "From: " . $nome . " <" . $sacLoja . ">" . PHP_EOL;
$headers .= "Return-Path: " . $sacLoja . PHP_EOL;
$headers .= "Reply-To: " . $sacLoja . PHP_EOL;

if (! mail($email, "Qual a melhor foto para meu ambiente? | $nome <$email>", $mensagem, $headers, "-r" . $sacLoja)) {
    Saida::json('Desculpe-nos, não foi possível enviar sua imagem no momento. Tente novamente mais tarde', true);
}

Saida::json('Sua solicitação foi enviada! Aguarde nosso contato.');