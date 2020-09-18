<?php

class Plateforme {
    
    /**
     * @var int Identifiant dans la base de données
     */
    private $idPlateforme;

    /**
     * @var string
     */
    private $nomPlateforme;

    /**
     * @param array $datas
     */
    function __construct(array $datas) {
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

    public function getIdPlateforme(): int {
        return $this->idPlateforme;
    }

    public function setIdPlateforme(int $idPlateforme): void {
        $this->idPlateforme = $idPlateforme;
    }

    public function getNomPlateforme(): string {
        return $this->nomPlateforme;
    }

    public function setNomPlateforme(string $nomPlateforme): void {
        $this->nomPlateforme = $nomPlateforme;
    }

}
