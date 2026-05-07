<?php

namespace App\AutoPlay\Controller;

use App\AutoPlay\Repository\VideoRepository;

class VideoRemoverController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processarRequisicao(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /index.php');
            exit;
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            echo 'ID do vídeo é inválido.';
            exit;
        }

        $this->videoRepository->remove($id);

        header('Location: /index.php');
        exit;
    }
}
