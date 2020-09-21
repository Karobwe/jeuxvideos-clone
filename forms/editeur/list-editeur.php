<?php
spl_autoload_register(function($classe){
  require_once '../../classes/'.$classe.'.class.php';
});

include '../../includes/header.php';

require_once('../../includes/db.php');
require_once('../../includes/functions.php');

$editeurManager = new EditeurManager($pdo);
$editeurs = $editeurManager->getAll();

?>

<h2>Liste des éditeurs</h2>

<div class="row pt-3">
  <div class="col-3 border-right">
    <a href="add-editeur.php" class="link btn btn-primary">Ajouter un éditeurs</a>
  </div>

  <div class="col-9">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Site web</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($editeurs as $editeur): ?>
          <tr>
            <th scope="row"><?= $editeur['idEditeur'] ?></th>
            <td><?= $editeur['nomEditeur'] ?></td>
            <td><a href="<?= $editeur['siteEditeur'] ?>"><?= $editeur['nomEditeur'] ?></a></td>
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