<?php require __DIR__ . '/inicio-html.php'; ?>

    <main class="container">

        <form class="container__formulario" enctype="multipart/form-data" action="<?= $actionForm ?>" method="post">
            <h2 class="formulario__titulo">Edite o video</h3>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input name="url" class="campo__escrita" required id='url' value="<?= $video ? $video->url : '' ?>" />
                </div>

                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <input name="titulo" class="campo__escrita" required id='titulo' value="<?= $video ? $video->titulo : '' ?>" />
                </div>

                <?php if( $video !== null && $video->getImgPath() !== null ): ?>
                    <img class="formulario__img" src="/img/upload/<?= $video->getImgPath() ?>" style="max-width: 200px;" alt="Imagem do video <?= $video->titulo ?>">
                    <input type="checkbox" name="removerImg" id="removerImg" value="1">
                    <label for="removerImg" style="color: black;">Remover imagem atual</label>
                <?php endif; ?>

                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Imagem do Video</label>
                    <input name="imgPath" type="file" class="campo__escrita" accept="image/*" id='imgPath' />
                </div>

                <?php if ($id !== false): ?>
                  <input type="hidden" name="id" value="<?= $video ? $video->id : '' ?>">
                <?php endif; ?>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>

<?php require __DIR__ . '/fim-html.php'; ?>