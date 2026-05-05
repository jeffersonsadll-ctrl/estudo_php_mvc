<?php 

namespace App\AutoPlay\Entity;

class Video
{

  public readonly int $id;
  public readonly string $url;

  public function __construct(
    string $url,
    public readonly string $titulo
  ){
    $this->setUrl($url);
  }

  /**
   * Summary of setUrl
   * @param string $url
   * @throws \InvalidArgumentException
   * @return void
   */
  private function setUrl(string $url): void
  {
    $validatedUrl = filter_var($url, FILTER_VALIDATE_URL);

    if ($validatedUrl === false) {
      throw new \InvalidArgumentException("URL inválida.");
    }

    $this->url = $validatedUrl;
  }

  /**
   * Summary of setId
   * @param int $id
   * @return void
   */
  public function setId(int $id): void
  {
    if (isset($this->id)) {
      throw new \LogicException("ID já foi definido para este vídeo.");
    }

    if ($id <= 0) {
      throw new \InvalidArgumentException("ID inválido.");
    }

    $this->id = $id;
  }
}