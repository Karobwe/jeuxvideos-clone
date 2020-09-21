<?php
spl_autoload_register(function($classe){
  require_once '../../classes/'.$classe.'.class.php';
});

include '../../includes/header.php';

require_once('../../includes/db.php');
require_once('../../includes/functions.php');

$jeuxManager = new JeuxManager($pdo);
$jeux = $jeuxManager->getAll();

?>

<h2>Liste des jeux</h2>

<div class="row pt-3">
  <div class="col-3 border-right">
    <a href="add-utilisateur.php" class="link btn btn-primary">Ajouter un jeux</a>
  </div>

  <div class="col-9">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Titre</th>
          <th scope="col">Description</th>
          <th scope="col">Pegi</th>
          <th scope="col">Date de sortie</th>
          <th scope="col">Catégorie</th>
          <th scope="col">Editeur</th>
          <th scope="col">Plateforme</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($jeux as $jeu): ?>
          <tr>
            <th scope="row"><?= $jeu['idJeux'] ?></th>
            <td><?= $jeu['titre'] ?></td>
            <td><?= '' //$jeu['description'] ?></td>
            <td><?= $jeu['pegi'] ?></td>
            <td><?= $jeu['dateSortie'] ?></td>
            <td><?= $jeu['nomCategorie'] ?></td>
            <td><?= $jeu['nomEditeur'] ?></td>
            <td><?= $jeu['nomPlateforme'] ?></td>
            <td>
              <a href=""><i class="fas fa-edit mr-3"></i></a>
              <a href=""><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include '../../includes/footer.php';