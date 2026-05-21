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
      
      if( array_key_exists('imgPath', $_FILES) && $_FILES['imgPath']['error'] == UPLOAD_ERR_OK )
      {
        $baseNamePath = uniqid('ul_') . "_" . pathinfo($_FILES['imgPath']['tmp_name'], PATHINFO_BASENAME);
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($_FILES['imgPath']['tmp_name']);

        if( str_starts_with($mimeType, 'image/') ){

          move_uploaded_file(
            $_FILES['imgPath']['tmp_name'],
            __DIR__ . '/../../public/img/upload/' . $baseNamePath
          );
  
          $video->setImgPath($baseNamePath);        

        }

      }

      $this->videoRepository->add($video);

      header('Location: ./index.php');
      exit;
    }
}