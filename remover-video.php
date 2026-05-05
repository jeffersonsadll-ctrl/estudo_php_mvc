<?php 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ./index.php');
  exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
  echo 'ID do vídeo é inválido.';
  exit;
}

// -------------------

use App\AutoPlay\Repository\VideoRepository;

$dbPath = __DIR__ . '/banco_dados.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$videoRepository = new VideoRepository($pdo);
$videoRepository->remove($id);

header('Location: ./index.php');
exit;