<?php 

$pdo = new PDO('sqlite:./banco_dados.sqlite');
$sql = "CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nome TEXT NOT NULL,
  email TEXT NOT NULL UNIQUE,
  senha TEXT NOT NULL
)";
$pdo->exec($sql);