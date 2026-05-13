<?php

namespace App\AutoPlay\Controller;

class LoginFormController implements Controller
{
  public function processarRequisicao(): void
  {
    include __DIR__ . '/../../view/login-form.php';
  }
}