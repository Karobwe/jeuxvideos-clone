<?php

spl_autoload_register(function($classe){
    require_once '../classes/'.$classe.'.class.php';
});

require_once '../includes/db.php';
require_once '../includes/functions.php';

include '../includes/header.php';
?>

<h1 class="h1">Test de la classe <strong>Editeur</strong> et son manager</h1>

<?php
$datas = array(
    'idEditeur' => 4,
    'nomEditeur' => 'Square Enix',
    'siteEditeur' => 'https://www.square-enix.com'
);

$editeurManager = new EditeurManager($pdo);

$editeur = new Editeur($datas);

echo '<p>Test de l\'ajout d\'un éditeur</p>';
$lastId = $editeurManager->add($editeur);
if($lastId) {
    $editeur->setIdEditeur($lastId);
    bootstrap_alert("L'éditeur {$editeur->getNomEditeur()} a bien été ajouter à la base de données");
}

echo '<p>Test de la récupération d\'un éditeur</p>';
if($editeurManager->get($lastId)) {
    bootstrap_alert("L'éditeur {$editeur->getNomEditeur()} a bien été récupérer");
}

echo '<p>Test de la modification d\'un éditeur</p>';
$ancien_nom = $editeur->getNomEditeur();
$editeur->setNomEditeur('Capcom');
$editeur->setSiteEditeur('www.capcom.com');
if($editeurManager->update($editeur)) {
    bootstrap_alert("L'éditeur $ancien_nom a été renommer en {$editeur->getNomEditeur()}");
}

echo '<p>Test de la suppression d\'un éditeur</p>';
if($editeurManager->delete($editeur)) {
    bootstrap_alert("L'éditeur {$editeur->getNomEditeur()} a bien été supprimer de la base de données");
}

?>

<h3>Liste des éditeurs dans la base de données:</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Site web</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $editeurs_list = $editeurManager->getAll();
    if($editeurs_list):
        foreach($editeurs_list as $editeur): ?>
            <tr>
                <th scope="row"><?= $editeur['idEditeur'] ?></th>
                <td><?= $editeur['nomEditeur'] ?></td>
                <td><?= $editeur['siteEditeur'] ?></td>
            </tr>
        <?php 
        endforeach; 
    endif;
    ?>
  </tbody>
</table>

<?php
include '../includes/footer.php';