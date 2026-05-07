<?php

namespace App\AutoPlay\Controller;

use App\AutoPlay\Repository\VideoRepository;
use App\AutoPlay\Entity\Video;

class VideoAtualizarController implements Controller
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
        $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
        $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$id || !$url || !$titulo) {
            echo 'Preencha todos os campos obrigatórios.';
            exit;
        }

        $video = new Video($url, $titulo);
        $video->setId($id);

        $this->videoRepository->update($video);

        header('Location: /index.php');
        exit;
    }
}
