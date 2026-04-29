<?php

$dirPath = __DIR__;
$fileRequire = "";

match ($_SERVER['PATH_INFO'] ?? '/') {
  "/" => $fileRequire = "/listagem-videos.php",
  "/enviar-video" => $fileRequire = "/formulario-video.php",
  "/editar-video" => $fileRequire = "/formulario-video.php",
  "/remover-video" => $fileRequire = "/remover-video.php",
  "/salvar-video" => $fileRequire = (array_key_exists('id', $_POST))?"/editar-video.php":"/inserir-video.php",
  default => $fileRequire = "/404.php"
};

require "{$dirPath}/../{$fileRequire}";