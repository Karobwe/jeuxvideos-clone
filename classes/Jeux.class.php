<?php

class Jeux {

  /**
   * @var int
   */
  private $idJeux;

  /**
   * @var string
   */
  private $titre;

  /**
   * @var string
   */
  private $description;

  /**
   * @var int
   */
  private $pegi;

  /**
   * @var string
   */
  private $siteJeux;

  /**
   * @var string
   */
  private $dateSortie;

  /**
   * @var int
   */
  private $idCategorie;

  /**
   * @var int
   */
  private $idEditeur;

  /**
   * @var int
   */
  private $idPlateforme;

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

  public function getIdJeux(): int {
    return $this->idJeux;
  }

  public function setIdJeux(int $idJeux): void {
    $this->idJeux = $idJeux;
  }

  public function getTitre(): string {
    return $this->titre;
  }

  public function setTitre(string $titre): void {
    $this->titre = $titre;
  }

  public function getDescription(): string {
    return $this->description;
  }

  public function setDescription(string $description): void {
    $this->description = $description;
  }

  public function getPegi(): int {
    return $this->pegi;
  }

  public function setPegi(int $pegi): void {
    $this->pegi = $pegi;
  }

  public function getSiteJeux(): string {
    return $this->siteJeux;
  }

  public function setSiteJeux(string $siteJeux): void {
    $this->siteJeux = $siteJeux;
  }

  public function getDateSortie(): string {
    return $this->dateSortie;
  }

  public function setDateSortie(string $dateSortie): void {
    $this->dateSortie = $dateSortie;
  }

  public function getIdCategorie(): int {
    return $this->idCategorie;
  }

  public function setIdCategorie(int $idCategorie): void {
    $this->idCategorie = $idCategorie;
  }

  public function getIdEditeur(): int {
    return $this->idEditeur;
  }

  public function setIdEditeur(int $idEditeur): void {
    $this->idEditeur = $idEditeur;
  }

  public function getIdPlateforme(): int {
    return $this->idPlateforme;
  }

  public function setIdPlateforme(int $idPlateforme) {
    $this->idPlateforme = $idPlateforme;
  }
    
}
