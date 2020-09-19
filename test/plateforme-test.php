<?php

spl_autoload_register(function($classe){
    require_once '../classes/'.$classe.'.class.php';
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

echo '<p>Test de l\'ajout d\'une plateforme</p>';
$lastId = $plateformeManager->add($plateforme);
if($lastId) {
    // Comme la colonne id est en auto_increment, la plateforme
    // n'auras pas forcément l'id qu'il avait avant donc
    // on récupère celle que la bdd lui a attribué
    $plateforme->setIdPlateforme($lastId);
    bootstrap_alert("La plateforme {$plateforme->getNomPlateforme()} a bien été ajouter à la base de données");
}

echo '<p>Test de la récupération d\'une plateforme</p>';
if($plateformeManager->get($lastId)) {
    bootstrap_alert("La plateforme {$plateforme->getNomPlateforme()} a bien été récupérer");
}

echo '<p>Test de la modification d\'une plateforme</p>';
$ancien_nom = $plateforme->getNomPlateforme();
$plateforme->setNomPlateforme('Switch');
if($plateformeManager->update($plateforme)) {
    bootstrap_alert("La plateforme $ancien_nom a été renommer en {$plateforme->getNomPlateforme()}");
}

echo '<p>Test de la suppression d\'une plateforme</p>';
if($plateformeManager->delete($plateforme)) {
    bootstrap_alert("La plateforme {$plateforme->getNomPlateforme()} a bien été supprimer de la base de données");
}

?>

<h3>Liste des plateformes dans la base de données:</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $plateformes_list = $plateformeManager->getAll();
    if($plateformes_list):
        foreach($plateformes_list as $plateforme): ?>
            <tr>
                <th scope="row"><?= $plateforme['idPlateforme'] ?></th>
                <td><?= $plateforme['nomPlateforme'] ?></td>
            </tr>
        <?php 
        endforeach; 
    endif;
    ?>
  </tbody>
</table>

<?php
include '../includes/footer.php';
