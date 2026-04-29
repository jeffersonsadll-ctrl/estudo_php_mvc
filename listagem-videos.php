<?php

$dbPath = __DIR__ . '/banco_dados.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT id, url, titulo FROM videos';
$stmt = $pdo->query($sql);
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/flexbox.css">
    <title>AutoPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

    <header>

        <nav class="cabecalho">
            <a class="logo" href="./index.html"></a>

            <div class="cabecalho__icones">
                <a href="/enviar-video" class="cabecalho__videos"></a>
                <a href="/login" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

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
</body>

</html>