<?php

class PlateformeManager {

    /**
     * @var PDO
     */
    private $pdo;

    function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function add(Plateforme $plateforme) {
        $stmt = $this->pdo->prepare("INSERT INTO `plateforme` (`idPlateforme`, `nomPlateforme`) 
            VALUES (NULL, :nomPlateform); 
        ");

        $stmt->bindValue($plateforme->getNomPlateforme(), PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        return $stmt->rowCount();
    }
    
}
