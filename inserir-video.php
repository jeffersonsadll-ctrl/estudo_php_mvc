<?php

use App\AutoPlay\Repository\VideoRepository;
use App\AutoPlay\Entity\Video;

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
$videoRepository = new VideoRepository($pdo);

$videoRepository->add(new Video($url, $titulo));

header('Location: ./index.php');
exit;