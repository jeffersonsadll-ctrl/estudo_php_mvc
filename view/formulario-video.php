<?php require __DIR__ . '/inicio-html.php'; ?>

    <main class="container">

        <form class="container__formulario" action="<?= $actionForm ?>" method="post">
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

<?php require __DIR__ . '/fim-html.php'; ?>