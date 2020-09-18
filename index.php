<?php
spl_autoload_register(function($classe){
  require_once 'classes/'.$classe.'.class.php';
});

include 'includes/header.php';

require_once('includes/db.php');
require_once('includes/functions.php');

$datas = array(
  'idPlateforme' => 9,
  'nomPlateforme' => 'Xbox One'
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

include 'includes/footer.php';
