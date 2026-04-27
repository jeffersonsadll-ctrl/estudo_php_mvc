<?php

$dbPath = __DIR__ . '/banco_dados.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$pdo->exec("CREATE TABLE IF NOT EXISTS videos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    url TEXT NOT NULL,
    titulo TEXT NOT NULL
)");

echo "Banco de dados criado com sucesso!";