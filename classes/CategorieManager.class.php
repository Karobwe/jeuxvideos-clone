<?php

class CategorieManager {

  /**
  * @var PDO
  */
  private $pdo;

  function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }

  /**
  * @param int $idCategorie
  * @return array|bool Tableau représentant la carégorie, ou false si elle n'a pas été trouver
  */
  public function get(int $idCategorie): array {
    $stmt = $this->pdo->prepare("SELECT * FROM `jeux_video`.`categorie`
      WHERE `idCategorie` = :idCategorie;
    ");

    $stmt->bindValue(':idCategorie', $idCategorie, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    $stmt->closeCursor();
      
    return $result;
  }

  /**
     * @param Categorie $categorie L'objet à insérer dans la base de données
     * @return int L'id dans la base de données de la catégorie qui vient dêtre insérer
     */
    public function add(Categorie $categorie): int {
      // Si aucune catégorie dans la bdd ne possède l'id on l'insére tel quel
      if(!$this->get($categorie->getIdCategorie())) {
        $stmt = $this->pdo->prepare("INSERT INTO `categorie` (`idCategorie`, `nomCategorie`) 
          VALUES (:idCategorie, :nomCategorie); 
        ");

        $stmt->bindValue(':idCategorie', $categorie->getIdCategorie(), PDO::PARAM_STR);
      } else {
        // On laisse la bdd générer un id
        $stmt = $this->pdo->prepare("INSERT INTO `categorie` (`idCategorie`, `nomCategorie`) 
          VALUES (NULL, :nomCategorie); 
        ");
      }

      $stmt->bindValue(':nomCategorie', $categorie->getNomCategorie(), PDO::PARAM_STR);
      $stmt->execute();
      $stmt->closeCursor();

      return $this->pdo->lastInsertId();
  }

  /**
     * Met à jour le nom d'une catégorie, sans toucher à son identifiant
     * 
     * @param Categorie $categorie L'objet à modifier
     * @return int  Le nombre de lignes affecter par la méthode
     */
    public function update(Categorie $categorie) {
      // Si la catégorie n'éxiste pas dans la base de données, 
      // on quitte directement la fonction
      if(!$this->get($categorie->getIdCategorie())) {
          bootstrap_alert('Impossible de récupérer la catégorie');
          return 0;
      } else {
          bootstrap_alert('La catégorie existe bien dans la bdd');
      }

      $stmt = $this->pdo->prepare("UPDATE `jeux_video`.`categorie` 
        SET `nomCategorie` = :nomCategorie 
        WHERE (`idCategorie` = :idCategorie);"
      );

      $stmt->bindValue(':nomCategorie', $categorie->getNomCategorie(), PDO::PARAM_STR);
      $stmt->bindValue(':idCategorie', $categorie->getIdCategorie(), PDO::PARAM_INT);
      $stmt->execute();
      $stmt->closeCursor();
      
      return $stmt->rowCount();
  }

  /**
     * Supprime une catégorie de la base de données
     * 
     * @param Categorie $categorie L'objet à supprimer
     * @return int  Le nombre de lignes affecter par la méthode
     */
    public function delete(Categorie $categorie) {
      // Si la catégorie n'éxiste pas dans la base de données, 
      // on quitte directement la fonction
      if(!$this->get($categorie->getIdCategorie())) {
          bootstrap_alert('Impossible de récupérer la catégorie');
          return 0;
      } else {
          bootstrap_alert('La catégorie existe bien dans la bdd');
      }

      $stmt = $this->pdo->prepare("DELETE FROM `jeux_video`.`categorie` WHERE (`idCategorie` = :idCategorie);");

      $stmt->bindValue(':idCategorie', $categorie->getIdCategorie(), PDO::PARAM_INT);
      $stmt->execute();
      $stmt->closeCursor();
      
      return $stmt->rowCount();
  }

  /**
     * @return array|bool La liste des catégorie sous forme de tableau de tableaux
     */
    public function getAll(): array {
      $stmt = $this->pdo->prepare("SELECT * FROM `jeux_video`.`categorie`;");
      $stmt->execute();
      $result = $stmt->fetchAll();
      $stmt->closeCursor();
      
      return $result;
  }
    
}
