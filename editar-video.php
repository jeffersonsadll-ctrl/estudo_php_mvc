<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ./pages/enviar-video.html');
  exit;
}

use App\AutoPlay\Repository\VideoRepository;
use App\AutoPlay\Entity\Video;

$dbPath = __DIR__ . '/banco_dados.sqlite';
$pdo = new PDO("sqlite:$dbPath"); 

$videoRepository = new VideoRepository($pdo);
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);

$video = new Video($url, $titulo);
$video->setId($id);
$videoRepository->update($video);

header('Location: ./index.php');
exit;