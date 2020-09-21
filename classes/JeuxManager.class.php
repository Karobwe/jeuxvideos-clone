<?php

spl_autoload_register(function($classe){
  require_once './'.$classe.'.class.php';
});

class JeuxManager {

  /**
  * @var PDO
  */
  private $pdo;

  /**
   * @var CategorieManager
   */
  private $categorieManager;

  /**
   * @var EditeurManager
   */
  private $editeurManager;

  /**
   * @var PlateformeManager
   */
  private $plateformeeManager;

  function __construct(PDO $pdo) {
    $this->pdo = $pdo;

    // On instancie les manager des tables étrangères
    $this->categorieManager = new CategorieManager($this->pdo);
    $this->editeurManager = new EditeurManager($this->pdo);
    $this->plateformeManager = new PlateformeManager($this->pdo);
  }

  /**
  * @param int $idJeux
  * @return array|bool Tableau représentant la Jeux, ou false si elle n'a pas été trouver
  */
  public function get(int $idJeux): array {
    $stmt = $this->pdo->prepare("SELECT * FROM `jeux_video`.`jeux`
      WHERE `idJeux` = :idJeux;
    ");

    $stmt->bindValue(':idJeux', $idJeux, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    $stmt->closeCursor();
      
    return $result;
  }

  /**
  * @param Jeux $jeux L'objet à insérer dans la base de données
  * @return int L'id dans la base de données du jeux qui vient dêtre insérer
  */
  public function add(Jeux $jeux): int {
    // Si les colonnes des tables étrangères n'éxiste pas, on stop le traitement
    $is_ok = false;
    if($this->categorieManager->get( $jeux->getIdCategorie() )) {
      // La catégorie du jeux existe
      if($this->editeurManager->get( $jeux->getIdEditeur() )) {
        // L'éditeur du jeux éxiste
        if($this->plateformeManager->get( $jeux->getIdPlateforme() )) {
          // La plateforme du jeux existe
          bootstrap_alert('La catégorie du jeu ainsi que son éditeur et sa platforme existe', 'success');
          $is_ok = true;
        } else {
          bootstrap_alert('La plateforme du jeu n\'existe pas', 'danger');
        }
      } else {
        bootstrap_alert('L\éditeur du jeu n\'existe pas', 'danger');
      }
    } else {
      bootstrap_alert('La catégorie du jeu n\'existe pas', 'danger');
    }

    if(!$is_ok) {
      return 0;
    }
    // Si la catégorie, la plateforme et l'éditeur existent bin, on continue le traitement

    // Si aucun jeux dans la bdd ne possède l'id on l'insére tel quel
    if(!$this->get($jeux->getIdJeux())) {
      $stmt = $this->pdo->prepare(
        "INSERT INTO `jeux_video`.`jeux` (`idJeux`, `titre`, `description`, `pegi`, `siteJeux`, 
          `dateSortie`, `idCategorie`, `idEditeur`, `idPlateforme`) 
        VALUES (:idJeux, :titre, :description, :pegi, :siteJeux, :dateSortie, :idCategorie, :idEditeur, :idPlateforme);"
      );

      $stmt->bindValue(':idJeux', $jeux->getIdJeux(), PDO::PARAM_STR);
    } else {
      // On laisse la bdd générer un id
      $stmt = $this->pdo->prepare(
        "INSERT INTO `jeux_video`.`jeux` (
          `idJeux`, `titre`, `description`, `pegi`, `siteJeux`, 
          `dateSortie`, `idCategorie`, `idEditeur`, `idPlateforme`) 
        VALUES (NULL, :titre, :description, :pegi, :siteJeux, :dateSortie, :idCategorie, :idEditeur, :idPlateforme);"
      );
    }

    $stmt->bindValue(':titre', $jeux->getTitre(), PDO::PARAM_STR);
    $stmt->bindValue(':description', $jeux->getDescription(), PDO::PARAM_STR);
    $stmt->bindValue(':pegi', $jeux->getPegi(), PDO::PARAM_STR);
    $stmt->bindValue(':siteJeux', $jeux->getSiteJeux(), PDO::PARAM_STR);
    $stmt->bindValue(':dateSortie', $jeux->getDateSortie(), PDO::PARAM_STR);
    $stmt->bindValue(':idCategorie', $jeux->getIdCategorie(), PDO::PARAM_STR);
    $stmt->bindValue(':idEditeur', $jeux->getIdEditeur(), PDO::PARAM_STR);
    $stmt->bindValue(':idPlateforme', $jeux->getIdPlateforme(), PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();

    return $this->pdo->lastInsertId();
  }

  /**
  * Met à jour le nom d'un jeux
  * 
  * @param Jeux $jeux L'objet à modifier
  * @return int  Le nombre de lignes affecter par la méthode
  */
  public function update(Jeux $jeux) {
    // Si le jeux n'éxiste pas dans la base de données, 
    // on quitte directement la fonction
    if(!$this->get($jeux->getIdJeux())) {
      bootstrap_alert('Impossible de récupérer le jeux');
      return 0;
    } else {
      bootstrap_alert('Le jeux existe bien dans la bdd');
    }

    $stmt = $this->pdo->prepare(
      "UPDATE `jeux_video`.`jeux` 
      SET `titre` = :titre, `description` = :description, `pegi` = :pegi, `siteJeux` = :siteJeux, 
        `dateSortie` = :dateSortie, `idCategorie` = :idCategorie, `idEditeur` = :idEditeur, `idPlateforme` = :idPlateforme 
      WHERE (`idJeux` = :idJeux);"
    );

      
    $stmt->bindValue(':titre', $jeux->getTitre(), PDO::PARAM_STR);
    $stmt->bindValue(':description', $jeux->getDescription(), PDO::PARAM_STR);
    $stmt->bindValue(':pegi', $jeux->getPegi(), PDO::PARAM_STR);
    $stmt->bindValue(':siteJeux', $jeux->getSiteJeux(), PDO::PARAM_STR);
    $stmt->bindValue(':dateSortie', $jeux->getDateSortie(), PDO::PARAM_STR);
    $stmt->bindValue(':idCategorie', $jeux->getIdCategorie(), PDO::PARAM_STR);
    $stmt->bindValue(':idEditeur', $jeux->getIdEditeur(), PDO::PARAM_STR);
    $stmt->bindValue(':idPlateforme', $jeux->getIdPlateforme(), PDO::PARAM_STR);
    $stmt->bindValue(':idJeux', $jeux->getIdJeux(), PDO::PARAM_STR);

    // $stmt = $this->pdo->prepare(
    //   "UPDATE `jeux_video`.`jeux` 
    //   SET `titre` = '{$jeux->getTitre()}', `description` = '{$jeux->getDescription()}', 
    //     `pegi` = '{$jeux->getPegi()}', `siteJeux` = '{$jeux->getSiteJeux()}', 
    //     `dateSortie` = '{$jeux->getDateSortie()}', `idCategorie` = '{$jeux->getIdCategorie()}', 
    //     `idEditeur` = '{$jeux->getIdEditeur()}', `idPlateforme` = '{$jeux->getIdPlateforme()}' 
    //   WHERE (`idJeux` = '{$jeux->getIdJeux()}');"
    // );

    $stmt->execute();
    $stmt->closeCursor();
      
    return $stmt->rowCount();
  }

  /**
  * Supprime un jeux de la base de données
  * 
  * @param Jeux $jeux L'objet à supprimer
  * @return int  Le nombre de lignes affecter par la méthode
  */
  public function delete(Jeux $jeux) {
    // Si le jeux n'éxiste pas dans la base de données, 
    // on quitte directement la fonction
    if(!$this->get($jeux->getIdJeux())) {
      bootstrap_alert('Impossible de récupérer le jeux');
      return 0;
    } else {
      bootstrap_alert('Le jeux existe bien dans la bdd');
    }

    $stmt = $this->pdo->prepare("DELETE FROM `jeux_video`.`jeux` WHERE (`idJeux` = :idJeux);");

    $stmt->bindValue(':idJeux', $jeux->getIdJeux(), PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
      
    return $stmt->rowCount();
  }

  /**
  * @return array|bool La liste des jeux sous forme de tableau de tableaux
  */
  public function getAll(): array {
    $stmt = $this->pdo->prepare("SELECT * FROM `jeux_video`.`jeux`;");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
      
    return $result;
  }

  /**
  * @param Jeux $jeux
  * @return string Nom de la catégorie du jeu
  */
  public function getCategorieName(Jeux $jeux): string {
    $stmt = $this->pdo->prepare("SELECT `nomCategorie` 
      FROM `jeux_video`.`jeux`
      JOIN `jeux_video`.`categorie`
      ON `jeux`.`idCategorie` = `categorie`.`idCategorie`
      WHERE `idJeux` = :idJeux
    ");

    $stmt->bindValue(':idJeux', $jeux->getIdJeux(), PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    $stmt->closeCursor();
      
    return $result['nomCategorie'];
  }

  /**
  * @param Jeux $jeux
  * @return string Nom de l'éditeur du jeu
  */
  public function getEditeurName(Jeux $jeux): string {
    $stmt = $this->pdo->prepare("SELECT `nomEditeur` 
      FROM `jeux_video`.`jeux`
      JOIN `jeux_video`.`editeur`
      ON `jeux`.`idEditeur` = `editeur`.`idEditeur`
      WHERE `idJeux` = :idJeux
    ");

    $stmt->bindValue(':idJeux', $jeux->getIdJeux(), PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    $stmt->closeCursor();
      
    return $result['nomEditeur'];
  }

  /**
  * @param Jeux $jeux
  * @return string Nom de la catégorie du jeu
  */
  public function getPlateformeName(Jeux $jeux): string {
    $stmt = $this->pdo->prepare("SELECT `nomPlateforme` 
      FROM `jeux_video`.`jeux`
      JOIN `jeux_video`.`plateforme`
      ON `jeux`.`idPlateforme` = `plateforme`.`idPlateforme`
      WHERE `idJeux` = :idJeux
    ");

    $stmt->bindValue(':idJeux', $jeux->getIdJeux(), PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    $stmt->closeCursor();
      
    return $result['nomPlateforme'];
  }
    
}
