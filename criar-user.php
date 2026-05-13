<?php

$pdo = new PDO('sqlite:./banco_dados.sqlite');

$nome = $argv[1] ?? 'Usuário Padrão';
$email = $argv[2] ?? '';
$senha = password_hash($argv[3] ?? 'senha123', PASSWORD_ARGON2ID);

$sql = "INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->execute();