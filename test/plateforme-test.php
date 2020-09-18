<?php

spl_autoload_register(function($classe){
    require_once 'classes/'.$classe.'.class.php';
});

require_once '../includes/db.php';
require_once '../includes/functions.php';

include '../includes/header.php';
?>

<h1 class="h1">Test de la classe <strong>Plateforme</strong> et son manager</h1>

<?php
$datas = array(
    'idPlateforme' => 3,
    'nomPlateforme' => 'PC'
);
  
$plateforme = new Plateforme($datas);
  
$plateformeManager = new PlateformeManager($pdo);
  
pre_var_dump($plateformeManager->get(9));
  
$plateforme->setNomPlateforme('PC');
$plateformeManager->update($plateforme);
  
pre_var_dump($plateformeManager->get(9));
  
die();
  
if($plateformeManager->add($plateforme)) {
    bootstrap_alert("La plateforme {$plateforme->getNomPlateforme()} a bien été ajouter à la base de donner");
}

include '../includes/footer.php';
