<?php
require_once 'Saida.php';

// Verifica se foi enviada uma foto (se não é acesso direto)
if (! isset($_FILES[ 'foto' ])) {
    Saida::json('Acesso Negado', true);
}

// Pega os dados enviados
$foto = $_FILES[ 'foto' ];
$nomeCliente = filter_input(INPUT_POST, 'nome');
$emailCliente = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$msgCliente = filter_input(INPUT_POST, 'msg');

// Verificando email
if (empty($emailCliente)) {
    Saida::json('Por favor, nos informe um email válido', true);
}

// Verificando imagem
if (! isset($foto[ 'tmp_name' ]) || empty($foto[ 'tmp_name' ]) || ! preg_match('/image/i', $foto[ 'type' ])) {
    Saida::json('Envie-nos uma foto do ambiente para que possamos indicar a melhor lâmpada para você', true);
}

// Email de origem (tem que ser um @aiha.com.br)
$emailOrigem = 'sac@aiha.com.br';

// Email para onde será enviado
$emailDestino = 'kaled@aiha.com.br';

// Mensagem email
$msgMail = preg_replace('/[\n\r\s\t]+/', ' ',
    "<html><body>
        <p>Olá, gostaria de saber qual a melhor lâmpada para meu ambiente.</p>
        <p>
            <strong>Nome: </strong> $nomeCliente<br>
            <strong>Email:</strong> $emailCliente<br>
            <strong>Mensagem:</strong> $msgCliente
        </p>
        <p>Email enviado de <a href='https://www.aiha.com.br/qlamp/' target='_blank'>Qual é a lâmpada</a> <small>(Imagem em anexo)</small>)</p>
    </body></html>"
);

// Setando o envio de email
require_once 'PHPMailer/class.phpmailer.php';
$mail = new PHPMailer();
$mail->setFrom($emailOrigem, $nomeCliente);
$mail->addReplyTo($emailCliente);
$mail->addAddress($emailDestino);
$mail->Subject = "Qual a melhor foto para meu ambiente? | $nomeCliente <$emailCliente>";
$mail->msgHTML($msgMail);
$mail->addAttachment($foto[ 'tmp_name' ], $foto[ 'name' ]);

// Foi enviado?
if (! $mail->send()) {
    Saida::json('Desculpe-nos, não foi possível enviar sua imagem no momento.' . PHP_EOL . 'Tente novamente mais tarde',
        true);
}

// Emite saída de sucesso
Saida::json('Sua solicitação foi enviada!' . PHP_EOL . 'Aguarde nosso contato.');