<?php http_response_code(404); ?>
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
    <title>404 - Página não encontrada | AutoPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <style>
        .container-404 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            text-align: center;
            gap: 1rem;
        }

        .container-404 h1 {
            font-size: 6rem;
            font-weight: 700;
            color: #ff0000;
        }

        .container-404 h2 {
            font-size: 1.5rem;
        }

        .container-404 p {
            font-size: 1rem;
            color: #555;
        }

        .container-404 a {
            margin-top: 1rem;
            padding: 0.75rem 1.5rem;
            background-color: #ff0000;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 700;
            transition: background-color 0.2s;
        }

        .container-404 a:hover {
            background-color: #cc0000;
        }
    </style>
</head>

<body>

    <header>
        <div class="cabecalho__container">
            <img src="./img/cabecalho/logo.png" alt="Logo AutoPlay">
        </div>
    </header>

    <main>
        <div class="container-404">
            <h1>404</h1>
            <h2>Página não encontrada</h2>
            <p>A página que você está procurando não existe ou foi removida.</p>
            <a href="/index.php">Voltar para a página inicial</a>
        </div>
    </main>

</body>

</html>
