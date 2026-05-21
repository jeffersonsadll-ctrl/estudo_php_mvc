<?php 

namespace App\AutoPlay\Controller;
use App\AutoPlay\Repository\VideoRepository;

class VideoFormController implements Controller
{

  public function __construct(private VideoRepository $videoRepository)
  {
  }

  public function processarRequisicao(): void
  {
    if( array_key_exists('id', $_POST) )
    {
      $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
      if (!$id) {
        echo 'ID do vídeo é inválido.';
        exit;
      }
      
      $video = $this->videoRepository->findById($id);
      $actionForm = '/atualizar-video';
    }
    else {
      $id = false;
      $video = null;
      $actionForm = '/inserir-video';
    }
    require __DIR__ . '/../../view/formulario-video.php';
  }
}