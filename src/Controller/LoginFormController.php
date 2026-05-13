<?php

namespace App\AutoPlay\Controller;

class LoginFormController implements Controller
{
  public function processarRequisicao(): void
  {
    if( array_key_exists("logged_in", $_SESSION) && $_SESSION['logged_in'] === true ) {
      header("Location: /");
      return;
    }

    include __DIR__ . '/../../view/login-form.php';
  }
}