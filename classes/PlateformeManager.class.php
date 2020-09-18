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
     * @return array
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
     * @return int Le nombre de lignes affecter par la méthode
     */
    public function add(Plateforme $plateforme): int {
        $stmt = $this->pdo->prepare("INSERT INTO `plateforme` (`idPlateforme`, `nomPlateforme`) 
            VALUES (NULL, :nomPlateform); 
        ");

        $stmt->bindValue(':nomPlateform', $plateforme->getNomPlateforme(), PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        return $stmt->rowCount();
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
            pre_var_dump('Impossible de récupérer la plateforme');
            return 0;
        } else {
            pre_var_dump('La plateforme existe bien dans la bdd');
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
    
}
