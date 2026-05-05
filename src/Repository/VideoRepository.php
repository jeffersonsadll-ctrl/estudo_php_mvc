<?php

namespace App\AutoPlay\Repository;

use PDO;
use App\AutoPlay\Entity\Video;

class VideoRepository
{
  /**
   * Summary of pdo
   * @var PDO
   */
  private PDO $pdo;

  /**
   * Summary of __construct
   * @param PDO $pdo
   * @return void
   */
  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  /**
   * Summary of add
   * @param Video $video
   * @return bool
   */
  public function add(Video $video): bool
  {
    $sql = "INSERT INTO videos (url, titulo) VALUES(?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $video->url);
    $stmt->bindValue(2, $video->titulo);

    $rs = $stmt->execute();

    $video->setId($this->pdo->lastInsertId());

    return $rs;
  }

  /**
   * Summary of remove
   * @param int $id
   * @return bool
   */
  public function remove(int $id): bool
  {
    $sql = "DELETE FROM videos WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);

    return $stmt->execute();
  }

  /**
   * Summary of update
   * @param Video $video
   * @return bool
   */
  public function update(Video $video): bool
  {
    $sql = "UPDATE videos SET url = :url, titulo = :titulo WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue("url", $video->url);
    $stmt->bindValue("titulo", $video->titulo);
    $stmt->bindValue("id", $video->id, PDO::PARAM_INT);

    return $stmt->execute();
  }

  /**
   * Summary of all
   * @return Video[]
   */
  public function all(): array
  {
    $sql = "SELECT id, url, titulo FROM videos";
    $stmt = $this->pdo->query($sql);

    $listVideos = array_map(function($dataVideo){
      $video = new Video($dataVideo['url'], $dataVideo['titulo']);
      $video->setId($dataVideo['id']);
      return $video;
    }, $stmt->fetchAll(PDO::FETCH_ASSOC));

    return $listVideos;
  }

  public function findById(int $id): ?Video
  {
    $sql = "SELECT id, url, titulo FROM videos WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue("id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $dataVideo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dataVideo) {
      return null;
    }

    $video = new Video($dataVideo['url'], $dataVideo['titulo']);
    $video->setId($dataVideo['id']);

    return $video;
  }
}