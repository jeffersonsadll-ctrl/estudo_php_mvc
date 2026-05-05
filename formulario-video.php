<?php 

use App\AutoPlay\Repository\VideoRepository;

$dbPath = __DIR__ . '/banco_dados.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$videoRepository = new VideoRepository($pdo);

if( array_key_exists('id', $_POST) )
{
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if (!$id) {
      echo 'ID do vídeo é inválido.';
      exit;
    }
    
    $video = $videoRepository->findById($id);
}
else {
    $id = false;
    $video = (object) [
        'url' => '',
        'titulo' => ''
    ];
}
?>

<?php require 'inicio-html.php'; ?>

    <main class="container">

        <form class="container__formulario" action="/salvar-video" method="post">
            <h2 class="formulario__titulo">Edite o video</h3>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input name="url" class="campo__escrita" required id='url' value="<?= $video ? $video->url : '' ?>" />
                </div>


                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <input name="titulo" class="campo__escrita" required id='titulo' value="<?= $video ? $video->titulo : '' ?>" />
                </div>

                <?php if ($id !== false): ?>
                  <?= $video ? $video->id : '' ?>
                  <input type="hidden" name="id" value="<?= $video ? $video->id : '' ?>">
                <?php endif; ?>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>

<?php require 'fim-html.php'; ?>