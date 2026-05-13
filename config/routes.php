<?php

return [
    "GET|/" => App\AutoPlay\Controller\VideoListController::class,
    "GET|/enviar-video" => App\AutoPlay\Controller\VideoFormController::class,
    "POST|/editar-video" => App\AutoPlay\Controller\VideoFormController::class,
    "POST|/remover-video" => App\AutoPlay\Controller\VideoRemoverController::class,
    "POST|/inserir-video" => App\AutoPlay\Controller\VideoInserirController::class,
    "POST|/atualizar-video" => App\AutoPlay\Controller\VideoAtualizarController::class,
    "GET|/login" => App\AutoPlay\Controller\LoginFormController::class,
    "POST|/login" => App\AutoPlay\Controller\LoginController::class,   
    "GET|/logout" => App\AutoPlay\Controller\LogoutController::class
];