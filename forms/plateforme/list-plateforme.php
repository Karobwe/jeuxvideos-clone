<?php
spl_autoload_register(function($classe){
  require_once '../../classes/'.$classe.'.class.php';
});

include '../../includes/header.php';

require_once('../../includes/db.php');
require_once('../../includes/functions.php');

$plateformeManager = new PlateformeManager($pdo);

$listePlateformes = $plateformeManager->getAll();

?>

<h2>Liste des plateformes de jeux</h2>

<div class="row pt-3">
  <div class="col-3">
    <a href="add-plateforme.php" class="link btn btn-primary">Ajouter une plateforme</a>
  </div>

  <div class="col-9">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom de la plateforme</th>
          <th scope="col"></th>
          <!-- <th scope="col">-</th> -->
        </tr>
      </thead>
      <tbody>
        <?php foreach($listePlateformes as $plateforme): ?>
          <tr>
            <th scope="row"><?= $plateforme['idPlateforme'] ?></th>
            <td><?= $plateforme['nomPlateforme'] ?></td>
            <td>
              <a href=""><i class="fas fa-edit mr-3"></i></a>
              <a href=""><i class="fas fa-trash-alt"></i></a>
            </td>
            <!-- <td><a href=""><i class="fas fa-trash-alt"></i></a></td> -->
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include '../../includes/footer.php';