<?php

namespace App\AutoPlay\Controller;

class LogoutController implements Controller
{
  public function processarRequisicao(): void
  {
    $_SESSION['logged_in'] = false;
    header("Location: /login");
  }
}