<?php

spl_autoload_register(function($classe){
    require_once '../classes/'.$classe.'.class.php';
});

require_once '../includes/db.php';
require_once '../includes/functions.php';

include '../includes/header.php';
?>

<h1 class="h1">Test de la classe <strong>Jeux</strong> et son manager</h1>

<?php
$datas = array(
    'idJeux' => 3,
    'titre' => 'Microsoft Flight Simulator',
    'description' => "Des appareils légers aux gros porteurs, pilotez des avions détaillés et fidèles dans la nouvelle génération de Microsoft Flight Simulator. Mettez à l'épreuve vos compétences dans des conditions exigeantes telles que le vol de nuit, la simulation atmosphérique et la météo réelle, dans un monde vivant et dynamique. Créez votre plan de vol et allez partout. Microsoft Flight Simulator comprend 20 avions extrêmement détaillés avec des modèles de vol uniques et 30 aéroports reproduits à la main.",
    'pegi' => 3,
    'siteJeux' => 'https://store.steampowered.com/app/1250410/',
    'dateSortie' => '2020-09-18',
    'idCategorie' => 7,
    'idEditeur' => 5,
    'idPlateforme' => 1
);

$jeux = new Jeux($datas);
$jeuxManager = new JeuxManager($pdo);

echo '<p>Test de l\'ajout d\'un jeu</p>';
$lastId = $jeuxManager->add($jeux);
if($lastId) {
    $jeux->setIdJeux($lastId);
    bootstrap_alert("Le jeu {$jeux->getTitre()} a bien été ajouter à la base de données");
}

echo '<p>Test de la récupération d\'un jeu</p>';
if($jeuxManager->get($lastId)) {
    bootstrap_alert("Le jeu {$jeux->getTitre()} a bien été récupérer");

    bootstrap_alert("Catégorie: {$jeuxManager->getCategorieName($jeux)}, plateforme: {$jeuxManager->getPlateformeName($jeux)}, éditeur: {$jeuxManager->getEditeurName($jeux)}", 'primary');
}


echo '<p>Test de la modification d\'un jeu</p>';
$ancien_titre = $jeux->getTitre();
$jeux->setTitre('Ori and the Will of the Wisps');
$jeux->setDescription("Le petit esprit Ori est habitué aux situations périlleuses. Mais lorsqu'un coup du sort met la jeune chouette Kun en danger, il faudra faire preuve d'une bravoure exceptionnelle pour rassembler une famille, soigner une terre tourmentée et découvrir la vraie destinée d'Ori. Les créateurs d'Ori and the Blind Forest, jeu d'action et de plateforme plébiscité par la critique, reviennent avec la suite tant attendue de leur œuvre. Lancez-vous dans une toute nouvelle aventure, au cœur d'un vaste monde regorgeant d'amis et d'ennemis dessinés à la main et plus vivants que jamais. Rythmé par une bande originale orchestrale, Ori and the Will of the Wisps perpétue le savoir-faire de Moon Studios en matière de plateforme haletante soutenue par une narration poignante.");
$jeux->setIdCategorie(1);
$jeux->setDateSortie('2020-03-11');
if($jeuxManager->update($jeux)) {
    bootstrap_alert("Le jeu $ancien_titre a été renommer en {$jeux->getTitre()}");
}

echo '<p>Test de la suppression d\'un jeu</p>';
if($jeuxManager->delete($jeux)) {
    bootstrap_alert("Le jeu {$jeux->getTitre()} a bien été supprimer de la base de données");
}

?>

<h3>Liste des jeux dans la base de données:</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titre</th>
      <th scope="col">Pegi</th>
      <th scope="col">Date de sortie</th>
      <th scope="col">Catégorie</th>
      <th scope="col">Editeur</th>
      <th scope="col">Plateforme</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $jeux_list = $jeuxManager->getAll();
    if($jeux_list):
        foreach($jeux_list as $jeu): ?>
            <tr>
                <th scope="row"><?= $jeu['idJeux'] ?></th>
                <th scope="row"><?= $jeu['titre'] ?></th>
                <th scope="row"><?= $jeu['pegi'] ?></th>
                <th scope="row"><?= $jeu['dateSortie'] ?></th>
                <th scope="row"><?= $jeu['nomCategorie'] ?></th>
                <th scope="row"><?= $jeu['nomEditeur'] ?></th>
                <th scope="row"><?= $jeu['nomPlateforme'] ?></th>
            </tr>
        <?php 
        endforeach; 
    endif;
    ?>
  </tbody>
</table>

<?php
include '../includes/footer.php';