<?php

class EditeurManager {

  /**
  * @var PDO
  */
  private $pdo;

  function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }

  /**
  * @param int $idEditeur
  * @return array|bool Tableau représentant l'éditeur, ou false si elle n'a pas été trouver
  */
  public function get(int $idEditeur): array {
    $stmt = $this->pdo->prepare("SELECT * FROM `jeux_video`.`editeur`
      WHERE `idEditeur` = :idEditeur;
    ");

    $stmt->bindValue(':idEditeur', $idEditeur, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    $stmt->closeCursor();
      
    return $result;
  }

  /**
  * @param Editeur $editeur L'objet à insérer dans la base de données
  * @return int L'id dans la base de données de la catégorie qui vient dêtre insérer
  */
  public function add(Editeur $editeur): int {
    // Si aucun éditeur dans la bdd ne possède l'id on l'insére tel quel
    if(!$this->get($editeur->getIdEditeur())) {
      $stmt = $this->pdo->prepare("INSERT INTO `jeux_video`.`editeur` (`idEditeur`, `nomEditeur`, `siteEditeur`) 
        VALUES (:idEditeur, :nomEditeur, :siteEditeur); 
      ");

      $stmt->bindValue(':idEditeur', $editeur->getIdEditeur(), PDO::PARAM_STR);
    } else {
      // On laisse la bdd générer un id
      $stmt = $this->pdo->prepare("INSERT INTO `jeux_video`.`editeur` (`idEditeur`, `nomEditeur`, `siteEditeur`) 
        VALUES (NULL, :nomEditeur, :siteEditeur); 
      ");
    }

    $stmt->bindValue(':nomEditeur', $editeur->getNomEditeur(), PDO::PARAM_STR);
    $stmt->bindValue(':siteEditeur', $editeur->getSiteEditeur(), PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();

    return $this->pdo->lastInsertId();
}

  /**
     * Met à jour un éditeur
     * 
     * @param Editeur $editeur L'objet à modifier
     * @return int  Le nombre de lignes affecter par la méthode
     */
    public function update(Editeur $editeur) {
      // Si la catégorie n'éxiste pas dans la base de données, 
      // on quitte directement la fonction
      if(!$this->get($editeur->getIdEditeur())) {
          bootstrap_alert('Impossible de récupérer l\'éditeur');
          return 0;
      } else {
          bootstrap_alert('L\'éditeur existe bien dans la bdd');
      }

      $stmt = $this->pdo->prepare("UPDATE `jeux_video`.`editeur` 
        SET `nomEditeur` = :nomEditeur, `siteEditeur` = :siteEditeur 
        WHERE (`idEditeur` = :idEditeur);"
      );

      $stmt->bindValue(':nomEditeur', $editeur->getNomEditeur(), PDO::PARAM_STR);
      $stmt->bindValue(':siteEditeur', $editeur->getSiteEditeur(), PDO::PARAM_STR);
      $stmt->bindValue(':idEditeur', $editeur->getIdEditeur(), PDO::PARAM_INT);
      $stmt->execute();
      $stmt->closeCursor();
      
      return $stmt->rowCount();
  }

  /**
     * Supprime une catégorie de la base de données
     * 
     * @param Editeur $editeur L'objet à supprimer
     * @return int  Le nombre de lignes affecter par la méthode
     */
    public function delete(Editeur $editeur) {
      // Si la catégorie n'éxiste pas dans la base de données, 
      // on quitte directement la fonction
      if(!$this->get($editeur->getIdEditeur())) {
          bootstrap_alert('Impossible de récupérer l\'éditeur');
          return 0;
      } else {
          bootstrap_alert('L\'éditeur existe bien dans la bdd');
      }

      $stmt = $this->pdo->prepare("DELETE FROM `jeux_video`.`editeur` WHERE (`idEditeur` = :idEditeur);");

      $stmt->bindValue(':idEditeur', $editeur->getIdEditeur(), PDO::PARAM_INT);
      $stmt->execute();
      $stmt->closeCursor();
      
      return $stmt->rowCount();
  }

  /**
     * @return array|bool La liste des éditeurs sous forme de tableau de tableaux
     */
    public function getAll(): array {
      $stmt = $this->pdo->prepare("SELECT * FROM `jeux_video`.`editeur`;");
      $stmt->execute();
      $result = $stmt->fetchAll();
      $stmt->closeCursor();
      
      return $result;
  }
    
}
