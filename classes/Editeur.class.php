<?php

class Editeur {

  /**
   * @var int
   */
  private $idEditeur;

  /**
   * @var string
   */
  private $nomEditeur;

  /**
   * @var string
   */
  private $siteEditeur;

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

  public function getIdEditeur(): int {
    return $this->idEditeur;
  }

  public function setIdEditeur(int $idEditeur): void {
    $this->idEditeur = $idEditeur;
  }

  public function getNomEditeur(): string {
    return $this->nomEditeur;
  }

  public function setNomEditeur(string $nomEditeur): void {
    $this->nomEditeur = $nomEditeur;
  }

  public function getSiteEditeur(): string {
    return $this->siteEditeur;
  }

  public function setSiteEditeur(string $siteEditeur): void {
    $this->siteEditeur = $siteEditeur;
  }
    
}
