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

// Pegando o email da loja
require_once '../config/conecta.class.php';
$pdo = new Conecta();
$sacLoja = 'kamile@tmw.com.br'; #$pdo->execute('SELECT CON_EMAIL_LOJA FROM config', true)->CON_EMAIL_LOJA;

// Mensagem email
$msgMail = preg_replace('/[\n\r\s\t]+/', ' ',
    "<html><body>
        <p>Olá, gostaria de saber qual a melhor lâmpada para meu ambiente.</p>
        <p>
            <strong>Nome: </strong> $nome<br>
            <strong>Email:</strong> $email<br>
            <strong>Mensagem:</strong> $msg
        </p>
        <p><small>Imagem em anexo.</small></p>
    </body></html>"
);

require_once 'PHPMailer/class.phpmailer.php';
$mail = new PHPMailer();
$mail->setFrom($sacLoja, $nome);
$mail->addReplyTo($email);
$mail->addAddress($sacLoja);
$mail->Subject = "Qual a melhor foto para meu ambiente? | $nome <$email>";
$mail->msgHTML($msgMail);
$mail->addAttachment($foto[ 'tmp_name' ], $foto[ 'name' ]);

if (! $mail->send()) {
    Saida::json('Desculpe-nos, não foi possível enviar sua imagem no momento. Tente novamente mais tarde', true);
}

Saida::json('Sua solicitação foi enviada! Aguarde nosso contato.');