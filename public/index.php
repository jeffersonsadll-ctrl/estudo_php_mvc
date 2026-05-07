<?php

use App\AutoPlay\Controller\VideoInserirController;
use App\AutoPlay\Controller\VideoAtualizarController;
use App\AutoPlay\Controller\VideoRemoverController;
use App\AutoPlay\Repository\VideoRepository;
use App\AutoPlay\Controller\VideoListController;

$dirPath = __DIR__;
$fileRequire = "";

require "{$dirPath}/../vendor/autoload.php";

$pdo = new PDO("sqlite:{$dirPath}/../banco_dados.sqlite");
$videoRepository = new VideoRepository($pdo);

match ($_SERVER['PATH_INFO'] ?? '/') {
  "/" => (new VideoListController($videoRepository))->processarRequisicao(),
  "/enviar-video" => $fileRequire = "/formulario-video.php",
  "/editar-video" => $fileRequire = "/formulario-video.php",
  "/remover-video" => (new VideoRemoverController($videoRepository))->processarRequisicao(),
  "/salvar-video" => (array_key_exists('id', $_POST))
                      ? (new VideoAtualizarController($videoRepository))->processarRequisicao()
                      : (new VideoInserirController($videoRepository))->processarRequisicao(),
  default => $fileRequire = "/404.php"
};

if( !empty($fileRequire)) {
  require "{$dirPath}/../{$fileRequire}";
}