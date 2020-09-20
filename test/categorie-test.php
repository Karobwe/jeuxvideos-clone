<?php

spl_autoload_register(function($classe){
    require_once '../classes/'.$classe.'.class.php';
});

require_once '../includes/db.php';
require_once '../includes/functions.php';

include '../includes/header.php';
?>

<h1 class="h1">Test de la classe <strong>Categorie</strong> et son manager</h1>

<?php
$datas = array(
    'idCategorie' => 6,
    'nomCategorie' => 'Horreur'
);

$categorieManager = new CategorieManager($pdo);

$categorie = new Categorie($datas);

echo '<p>Test de l\'ajout d\'une catégorie</p>';
$lastId = $categorieManager->add($categorie);
if($lastId) {
    $categorie->setIdCategorie($lastId);
    bootstrap_alert("La catégorie {$categorie->getNomCategorie()} a bien été ajouter à la base de données");
}

echo '<p>Test de la récupération d\'une catégorie</p>';
if($categorieManager->get($lastId)) {
    bootstrap_alert("La catégorie {$categorie->getNomCategorie()} a bien été récupérer");
}

echo '<p>Test de la modification d\'une catégorie</p>';
$ancien_nom = $categorie->getNomCategorie();
$categorie->setNomCategorie('Aventure');
if($categorieManager->update($categorie)) {
    bootstrap_alert("La catégorie $ancien_nom a été renommer en {$categorie->getNomCategorie()}");
}

echo '<p>Test de la suppression d\'une catégorie</p>';
if($categorieManager->delete($categorie)) {
    bootstrap_alert("La categorie {$categorie->getNomCategorie()} a bien été supprimer de la base de données");
}

?>

<h3>Liste des catégories dans la base de données:</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $categories_list = $categorieManager->getAll();
    if($categories_list):
        foreach($categories_list as $categorie): ?>
            <tr>
                <th scope="row"><?= $categorie['idCategorie'] ?></th>
                <td><?= $categorie['nomCategorie'] ?></td>
            </tr>
        <?php 
        endforeach; 
    endif;
    ?>
  </tbody>
</table>

<?php
include '../includes/footer.php';