<?php

spl_autoload_register(function($classe){
    require_once '../classes/'.$classe.'.class.php';
});

require_once '../includes/db.php';
require_once '../includes/functions.php';

include '../includes/header.php';
?>

<h1 class="h1">Test de la classe <strong>Utilisateur</strong> et son manager</h1>

<?php

$datas = array(
    'idUtilisateur' => 2,
    'pseudo' => 'Bar',
    'email' => 'bar@bar.bar',
    'password' => 'barbarbar',
    'status' => 'utilisateur'
);

$utilisateur = new Utilisateur($datas);

$utilisateurManager = new UtilisateurManager($pdo);

echo '<p>Test de l\'ajout d\'une plateforme</p>';
$lastId = $utilisateurManager->add($utilisateur);
if($lastId) {
    // Au cas où la bdd a donnée une autre id
    $utilisateur->setIdUtilisateur($lastId);
    bootstrap_alert("L'utilisateur {$utilisateur->getPseudo()} a bien été ajouter à la base de données");
}

echo '<p>Test de la récupération d\'un utilisateur</p>';
if($utilisateurManager->get(1)) {
    bootstrap_alert("L'utilisateur a bien été récupérer");
}

echo '<p>Test de la modification d\'une plateforme</p>';
$ancien_pseudo = $utilisateur->getPseudo();
$utilisateur->setPseudo('Baz');
$utilisateur->setEmail('baz@baz.baz');
if($utilisateurManager->update($utilisateur)) {
    bootstrap_alert("L'utilisateur $ancien_pseudo a été renommer en {$utilisateur->getPseudo()}");
}

echo '<p>Test de la suppression d\'une plateforme</p>';
if($utilisateurManager->delete($utilisateur)) {
    bootstrap_alert("L'utilisateur {$utilisateur->getPseudo()} a bien été supprimer de la base de donner");
}

?>

<h3>Liste des utilisateurs dans la base de données:</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Pseudo</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Statut</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $utilisateurs_list = $utilisateurManager->getAll();
    if($utilisateurs_list):
        foreach($utilisateurs_list as $utilisateur): ?>
            <tr>
                <th scope="row"><?= $utilisateur['idUtilisateur'] ?></th>
                <td><?= $utilisateur['pseudo'] ?></td>
                <td><?= $utilisateur['email'] ?></td>
                <td><?= $utilisateur['password'] ?></td>
                <td><?= $utilisateur['statut'] ?></td>
            </tr>
        <?php 
        endforeach; 
    endif;
    ?>
  </tbody>
</table>

<?php
include '../includes/footer.php';