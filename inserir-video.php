<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ./pages/enviar-video.html');
  exit;
}

$url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);

if (!$url || !$titulo) {
  echo 'Preencha todos os campos obrigatorios.';
  exit;
}

$dbPath = __DIR__ . '/banco_dados.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'INSERT INTO videos (url, titulo) VALUES (:url, :titulo)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':url', $url);
$stmt->bindValue(':titulo', $titulo);
$stmt->execute();

header('Location: ./index.php');
exit;