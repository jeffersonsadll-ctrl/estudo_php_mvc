<?php 

namespace App\AutoPlay\Controller;

use App\AutoPlay\Repository\VideoRepository;

class VideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processarRequisicao(): void
    {
        $videos = $this->videoRepository->all();
        require __DIR__ . '/../../listagem-videos.php';
    }
}