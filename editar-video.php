<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ./pages/enviar-video.html');
  exit;
}

$dbPath = __DIR__ . '/banco_dados.sqlite';
$pdo = new PDO("sqlite:$dbPath"); 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'UPDATE videos SET url = :url, titulo = :titulo WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':url', filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL));
$stmt->bindValue(':titulo', filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS));
$stmt->bindValue(':id', filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT), PDO::PARAM_INT);
$stmt->execute();

header('Location: ./index.php');
exit;