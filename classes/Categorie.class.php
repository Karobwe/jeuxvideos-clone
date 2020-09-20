<?php

class Categorie {

  /**
   * @var int
   */
  private $idCategorie;

  /**
   * @var string
   */
  private $nomCategorie;

  public function __construct($datas) {
    foreach ($datas as $key => $value) {
      // On récupère le nom du setter correspondant à l'attribut.
      $method = 'set'.ucfirst($key);
      // Si le setter correspondant existe.
      if (method_exists($this, $method)) {
          // On appelle le setter.
          $this->$method($value);
      }
    }
  }

  public function getIdCategorie(): int {
    return $this->idCategorie;
  }

  public function setIdCategorie(int $idCategorie): void {
    $this->idCategorie = $idCategorie;
  }

  public function getNomCategorie(): string {
    return $this->nomCategorie;
  }

  public function setNomCategorie(string $nomCategorie): void {
    $this->nomCategorie = $nomCategorie;
  }
    
}
