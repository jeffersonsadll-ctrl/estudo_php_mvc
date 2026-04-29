<?php

$dbPath = __DIR__ . '/banco_dados.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT id, url, titulo FROM videos';
$stmt = $pdo->query($sql);
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require 'inicio-html.php'; ?>

    <ul class="videos__container" alt="videos">
        <?php foreach( $videos as $video ): ?>
        <li class="videos__item">
            <iframe width="100%" height="72%" src="<?= $video['url'] ?>"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <div class="descricao-video">
                <img src="./img/logo.png" alt="logo canal">
                <h3><?= $video['titulo'] ?></h3>
                <div class="acoes-video">
                    <form method="post" action="/editar-video" style="display: inline;">
                      <input type="hidden" name="id" value="<?= $video['id'] ?>">
                      <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; text-decoration: underline;">Editar</button>
                    </form>
                    <form method="post" action="/remover-video" style="display: inline;">
                      <input type="hidden" name="id" value="<?= $video['id'] ?>">
                      <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; text-decoration: underline;">Excluir</button>
                    </form>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>

<?php require 'fim-html.php'; ?>