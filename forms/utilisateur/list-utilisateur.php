<?php
spl_autoload_register(function($classe){
  require_once '../../classes/'.$classe.'.class.php';
});

include '../../includes/header.php';

require_once('../../includes/db.php');
require_once('../../includes/functions.php');

$utilisateurManager = new UtilisateurManager($pdo);

$utilisateurs = $utilisateurManager->getAll();

?>

<h2>Liste des utilisateur</h2>

<div class="row pt-3">
  <div class="col-3 border-right">
    <a href="add-utilisateur.php" class="link btn btn-primary">Ajouter un utilisateur</a>
  </div>

  <div class="col-9">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Pseudo</th>
          <th scope="col">Password</th>
          <th scope="col">Email</th>
          <th scope="col">Status</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($utilisateurs as $utilisateur): ?>
          <tr>
            <th scope="row"><?= $utilisateur['idUtilisateur'] ?></th>
            <td><?= $utilisateur['pseudo'] ?></td>
            <td><?= $utilisateur['password'] ?></td>
            <td><?= $utilisateur['email'] ?></td>
            <td><?= $utilisateur['statut'] ?></td>
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