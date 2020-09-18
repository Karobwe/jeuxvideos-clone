<?php

class PlateformeManager {

    /**
     * @var PDO
     */
    private $pdo;

    function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param int $idPlatforme
     * @return array|bool Tableau représentant la plateforme, ou false si elle n'a pas été trouver
     */
    public function get(int $idPlateforme): array {
        $stmt = $this->pdo->prepare("SELECT * FROM `jeux_video`.`plateforme` 
            WHERE `idPlateforme` = :idPlateforme;"
        );

        $stmt->bindValue(':idPlateforme', $idPlateforme, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        
        return $result;
    }

    /**
     * @param Plateforme $plateforme L'objet à insérer dans la base de données
     * @return int L'id dans la base de données de la plateforme qui vient dêtre insérer
     */
    public function add(Plateforme $plateforme): int {
        $stmt = $this->pdo->prepare("INSERT INTO `plateforme` (`idPlateforme`, `nomPlateforme`) 
            VALUES (NULL, :nomPlateform); 
        ");

        $stmt->bindValue(':nomPlateform', $plateforme->getNomPlateforme(), PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        return $this->pdo->lastInsertId();
    }

    /**
     * Met à jour le nom d'une catégorie, sans toucher à son identifiant
     * 
     * @param Plateforme $plateforme L'objet à modifier
     * @return int  Le nombre de lignes affecter par la méthode
     */
    public function update(Plateforme $plateforme) {
        // Si la platefomre n'éxiste pas dans la base de données, 
        // on quitte directement la fonction
        if(!$this->get($plateforme->getIdPlateforme())) {
            bootstrap_alert('Impossible de récupérer la plateforme');
            return 0;
        } else {
            bootstrap_alert('La plateforme existe bien dans la bdd');
        }

        $stmt = $this->pdo->prepare("UPDATE `jeux_video`.`plateforme` 
            SET `nomPlateforme` = :nomPlateforme 
            WHERE (`idPlateforme` = :idPlateforme);"
        );

        $stmt->bindValue(':nomPlateforme', $plateforme->getNomPlateforme(), PDO::PARAM_STR);
        $stmt->bindValue(':idPlateforme', $plateforme->getIdPlateforme(), PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        
        return $stmt->rowCount();
    }

    /**
     * Supprime une catégorie de la base de données
     * 
     * @param Plateforme $plateforme L'objet à supprimer
     * @return int  Le nombre de lignes affecter par la méthode
     */
    public function delete(Plateforme $plateforme) {
        // Si la platefomre n'éxiste pas dans la base de données, 
        // on quitte directement la fonction
        if(!$this->get($plateforme->getIdPlateforme())) {
            bootstrap_alert('Impossible de récupérer la plateforme');
            return 0;
        } else {
            bootstrap_alert('La plateforme existe bien dans la bdd');
        }

        $stmt = $this->pdo->prepare("DELETE FROM `jeux_video`.`plateforme` WHERE (`idPlateforme` = :idPlateforme);");

        $stmt->bindValue(':idPlateforme', $plateforme->getIdPlateforme(), PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        
        return $stmt->rowCount();
    }

    /**
     * @return array|bool La liste des plateforme sous forme de tableau de tableaux
     */
    public function getAll(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM `jeux_video`.`plateforme`;");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        
        return $result;
    }
    
}
