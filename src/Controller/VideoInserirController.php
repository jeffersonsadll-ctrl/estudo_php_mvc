<?php 

namespace App\AutoPlay\Controller;

use App\AutoPlay\Repository\VideoRepository;
use App\AutoPlay\Entity\Video;

class VideoInserirController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processarRequisicao(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ./pages/enviar-video.html');
        exit;
      }

      $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
      $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);

      if (!$url || !$titulo) {
        echo 'Preencha todos os campos obrigatorios.';
        exit;
      }

      $video = new Video($url, $titulo);
      
      if( isset($_FILES['imgPath']) && $_FILES['imgPath']['error'] == UPLOAD_ERR_OK )
      {
        $imgPath_temp = $_FILES['imgPath']['tmp_name'];

        move_uploaded_file(
          $imgPath_temp,
          __DIR__ . '/../../public/img/upload/' . $_FILES['imgPath']['name']
        );

        $imgPath = $_FILES['imgPath']['name'];

        $video->setImgPath($imgPath);        
      }

      $this->videoRepository->add($video);

      header('Location: ./index.php');
      exit;
    }
}