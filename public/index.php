<?php
session_start();

$dirPath = __DIR__;
$fileRequire = "";

require "{$dirPath}/../vendor/autoload.php";

use App\AutoPlay\Controller\{
  VideoInserirController,
  VideoFormController,
  VideoListController,
  VideoRemoverController,
  VideoSalvarController,
  Erro404Controller
};
use App\AutoPlay\Repository\VideoRepository;


$pdo = new PDO("sqlite:{$dirPath}/../banco_dados.sqlite");
$videoRepository = new VideoRepository($pdo);

$rotas = require "{$dirPath}/../config/routes.php";

$metodoHttp = $_SERVER['REQUEST_METHOD'];
$caminho = $_SERVER['PATH_INFO'] ?? '/';
$key = "{$metodoHttp}|{$caminho}";

$isLoginRoute = $caminho === '/login';
if( !$isLoginRoute && !array_key_exists('logged_in', $_SESSION) ){
  header("Location: /login");
  return;
}

if( array_key_exists($key, $rotas) )
{
  $controllerClass = new $rotas[$key]($videoRepository);
}
else 
{
  $controllerClass = new Erro404Controller();
}

$controllerClass->processarRequisicao();