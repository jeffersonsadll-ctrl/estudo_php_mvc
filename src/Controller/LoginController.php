<?php

namespace App\AutoPlay\Controller;

use PDO;

class LoginController implements Controller
{

  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = new PDO("sqlite:" . __DIR__ . "/../../banco_dados.sqlite");
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function processarRequisicao(): void
  {
    $email          = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_EMAIL);
    $senhaDigitada  = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(1, $email);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if($usuario && password_verify($senhaDigitada, $usuario['senha'] ?? '')) {
      header("Location: /");
    }
    else {
      header("Location: /login?error=1");
    }

  }
}