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
        $videoAtual = $this->videoRepository->findById($id);

        if( isset($_POST['removerImg']) ){
            // remover a img atual da pasta uploads
            if( $videoAtual->getImgPath() !== null ){
                $caminhoImgAtual = __DIR__ . '/../../public/img/upload/' . $videoAtual->getImgPath();
                if( file_exists($caminhoImgAtual) ){
                    unlink($caminhoImgAtual);
                }
            }
            $video->setImgPath(null);
        }
        else if( array_key_exists('imgPath', $_FILES) && $_FILES['imgPath']['error'] === UPLOAD_ERR_OK ){
            // remover a img atual da pasta uploads
            if( $videoAtual->getImgPath() !== null ){
                $caminhoImgAtual = __DIR__ . '/../../public/img/upload/' . $videoAtual->getImgPath();
                if( file_exists($caminhoImgAtual) ){
                    unlink($caminhoImgAtual);
                }
            }

            // salvar a nova img na pasta uploads
            $nomeArquivo = uniqid('ul_') . "_" . pathinfo($_FILES['imgPath']['name'], PATHINFO_BASENAME);
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['imgPath']['tmp_name']);

            if( str_starts_with($mimeType, 'image/') ){
                move_uploaded_file(
                    $_FILES['imgPath']['tmp_name'],
                    __DIR__.'/../../public/img/upload/' . $nomeArquivo
                );
                $video->setImgPath($nomeArquivo);
            }
        }
        else {
            // manter a img atual caso nenhuma nova img seja enviada
            $video->setImgPath($videoAtual->getImgPath());
        }

        $video->setId($id);

        $this->videoRepository->update($video);

        header('Location: /index.php');
        exit;
    }
}
