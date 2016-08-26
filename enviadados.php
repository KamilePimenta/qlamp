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
$pathImg = __DIR__ . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . $foto[ 'name' ];
if (! @move_uploaded_file($foto[ 'tmp_name' ], $pathImg)) {
    Saida::json(
        'Desculpe, não consegui receber seu arquivo.',
        true
    );
}

require_once '../config/conecta.class.php';
$pdo = new Conecta();

$sacLoja = $pdo->execute('SELECT CON_EMAIL_LOJA FROM config', true)->CON_EMAIL_LOJA;
?>

<img src="img/tmp/<?=$foto[ 'name' ] ?>" alt="<?=$foto[ 'name' ] ?>" width="100">
