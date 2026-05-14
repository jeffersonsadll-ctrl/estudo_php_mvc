
<?php require __DIR__ . '/inicio-html.php'; ?>

    <ul class="videos__container" alt="videos">
        <?php foreach( $videos as $video ): ?>
        <li class="videos__item">
            <?php if( $video->getImgPath() !== null ): ?>

                <a href="<?= $video->url ?>" target="_blank">
                    <img class="thumbnail" src="img/upload/<?= $video->getImgPath() ?>" alt="Thumbnail do video" style="max-width: 420px;" />
                </a>

            <?php else: ?>

                <iframe width="100%" height="72%" src="<?= $video->url ?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>

            <?php endif; ?>
            <div class="descricao-video">
                <img src="<?= '/img/logo.png' ?>" alt="logo canal">
                <h3><?= $video->titulo ?></h3>
                <div class="acoes-video">
                    <form method="post" action="/editar-video" style="display: inline;">
                      <input type="hidden" name="id" value="<?= $video->id ?>">
                      <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; text-decoration: underline;">Editar</button>
                    </form>
                    <form method="post" action="/remover-video" style="display: inline;">
                      <input type="hidden" name="id" value="<?= $video->id ?>">
                      <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; text-decoration: underline;">Excluir</button>
                    </form>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>

<?php require __DIR__ . '/fim-html.php'; ?>