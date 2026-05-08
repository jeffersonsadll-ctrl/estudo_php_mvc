<?php

namespace App\AutoPlay\Controller;

class Controller404Error implements Controller
{
    public function processarRequisicao(): void
    {
        http_response_code(404);
        echo "Página não encontrada";
        exit;
    }
}