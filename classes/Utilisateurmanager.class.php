<?php

class UtilisateurManager {
    
    /**
     * @var PDO
     */
    private $pdo;

    function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param int $idUtilisateur
     * @return array|bool Tableau représentant l'utilisateur, ou false si elle n'a pas été trouver
     */
    public function get(int $idUtilisateur): array {
        $stmt = $this->pdo->prepare("SELECT * FROM `jeux_video`.`utilisateurs` 
            WHERE `idUtilisateur` = :idUtilisateur;"
        );

        $stmt->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        
        return $result;
    }

    /**
     * @param Utilisateur $utilisateur L'objet à insérer dans la base de données
     * @return int L'id dans la base de données de l'utilisateur qui vient dêtre insérer
     */
    public function add(Utilisateur $utilisateur): int {
        // On vérifie si le status est valide, si ce n'est pas le cas
        // on se sert de cette variable pour laisser la base de données
        // mettre le statut par défaut
        $is_statut_valide = false;
        if(!in_array($utilisateur->getStatus(), $this->getStatutValues())) {
            bootstrap_alert("Le status {$utilisateur->getStatus()} n'existe pas");
            $is_statut_valide = false;
        } else {
            bootstrap_alert("Le status {$utilisateur->getStatus()} existe bien");
            $is_statut_valide = true;
        }

        // Si aucun utilisateur ne possède l'id de celui dont on veut ajouter
        // on l'ajoute avec cette id
        if(!$this->get($utilisateur->getIdUtilisateur())) {
            if($is_statut_valide) {
                $stmt = $this->pdo->prepare("INSERT INTO `jeux_video`.`utilisateurs` (`idUtilisateur`, `pseudo`, `email`, `password`, `statut`) 
                    VALUES (:idUtilisateur, :pseudo, :email, :password, :status); 
                ");
                $stmt->bindValue(':status', $utilisateur->getStatus(), PDO::PARAM_STR);
            } else {
                // Si le statut n'est pas valide, on laisse la bdd mettre la valeur par défaut
                $stmt = $this->pdo->prepare("INSERT INTO `jeux_video`.`utilisateurs` (`idUtilisateur`, `pseudo`, `email`, `password`) 
                    VALUES (:idUtilisateur, :pseudo, :email, :password); 
                ");
            }

            $stmt->bindValue(':idUtilisateur', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
        } else {
            // Sinon on laisse la bdd attribuer une id au nouvel utilisateur
            if($is_statut_valide) {
                $stmt = $this->pdo->prepare("INSERT INTO `jeux_video`.`utilisateurs` (`pseudo`, `email`, `password`, `statut`) 
                    VALUES (:pseudo, :email, :password, :status); 
                ");
                $stmt->bindValue(':status', $utilisateur->getStatus(), PDO::PARAM_STR);
            } else {
                // Si le statut n'est pas valide, on laisse la bdd mettre la valeur par défaut
                $stmt = $this->pdo->prepare("INSERT INTO `jeux_video`.`utilisateurs` (`pseudo`, `email`, `password`) 
                    VALUES (:pseudo, :email, :password); 
                ");
            }
        }

        $stmt->bindValue(':pseudo', $utilisateur->getPseudo(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $utilisateur->getPassword(), PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        return $this->pdo->lastInsertId();
    }

    /**
     * Met à jour un utilisateur, en se basant sur son identifiant
     * 
     * @param Utilisateur $utilisateur L'objet à modifier
     * @return int  Le nombre de lignes affecter par la méthode
     */
    public function update(Utilisateur $utilisateur) {
        // Si l'utilisateur n'éxiste pas dans la base de données, 
        // on quitte directement la fonction
        if(!$this->get($utilisateur->getIdUtilisateur())) {
            bootstrap_alert('Impossible de récupérer l\'utilisateur');
            return 0;
        } else {
            bootstrap_alert('L\'utilisateur existe bien dans la bdd');
        }

        $stmt = $this->pdo->prepare("UPDATE `jeux_video`.`utilisateurs` 
            SET `pseudo` = :pseudo, `email` = :email, `password` = :password, `statut` = :statut 
            WHERE (`idUtilisateur` = :idUtilisateur);"
        );

        $stmt->bindValue(':pseudo', $utilisateur->getPseudo(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $utilisateur->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':statut', $utilisateur->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(':idUtilisateur', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        
        return $stmt->rowCount();
    }

    /**
     * Supprime un utilisateur de la base de données
     * 
     * @param Utilisateur $utilisateur L'objet à supprimer
     * @return int  Le nombre de lignes affecter par la méthode
     */
    public function delete(Utilisateur $utilisateur) {
        // Si l'utilisateur n'éxiste pas dans la base de données, 
        // on quitte directement la fonction
        if(!$this->get($utilisateur->getIdUtilisateur())) {
            bootstrap_alert('Impossible de récupérer l\'utilisateur');
            return 0;
        } else {
            bootstrap_alert('L\'utilisateur existe bien dans la bdd');
        }

        $stmt = $this->pdo->prepare("DELETE FROM `jeux_video`.`utilisateurs` WHERE (`idUtilisateur` = :idUtilisateur);");

        $stmt->bindValue(':idUtilisateur', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        
        return $stmt->rowCount();
    }

    /**
     * @return array|bool La liste des utilisateurs sous forme de tableau de tableaux
     */
    public function getAll(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM `jeux_video`.`utilisateurs`;");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        
        return $result;
    }

    /**
     * @return array Tableau représentant les valeurs possible de la colonne statut (type ENUM)
     */
    public function getStatutValues() {
        try {
            if(is_null($this->pdo)) return;
    
            $stmt = $this->pdo->prepare("SHOW COLUMNS FROM `jeux_video`.`utilisateurs` WHERE Field = 'statut';");
            $stmt->execute();
                        
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            preg_match("/^enum\(\'(.*)\'\)$/", $result['Type'], $matches);
            $enum = explode("','", $matches[1]);
            return $enum;
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    
        $pdo = NULL;
        return $enum;
    }

}
