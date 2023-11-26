<?php

require ('./data/conection.php');

$email = $argv[1];
$senha = $argv[2];

$senha = password_hash($senha, PASSWORD_ARGON2ID);



$sql = "INSERT INTO usuarios (email, senha) VALUES  (:email, :senha)";
$pdo->prepare($sql)->execute([
    ':email' => $email,
    ':senha' => $senha,

]);
