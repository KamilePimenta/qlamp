<?php
if (! isset($_FILES[ 'foto' ]) || empty($_FILES[ 'foto' ])) {
    die('Acesso Negado');
}

$foto = $_FILES[ 'foto' ];
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$msg = filter_input(INPUT_POST, 'msg');

require_once '../config/conecta.class.php';
$pdo = new Conecta();

$sacLoja = $pdo->execute('SELECT CON_EMAIL_LOJA FROM config', true)->CON_EMAIL_LOJA;

die($sacLoja);