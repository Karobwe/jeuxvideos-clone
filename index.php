<?php
spl_autoload_register(function($classe){
  require_once 'classes/'.$classe.'.class.php';
});

include 'includes/header.php';

require_once('includes/db.php');
require_once('includes/functions.php');
?>
<section id="forms">
    <div class="text-left">
        <h3 class="h3">Gestion des éléments</h3>
        <small>Utiliser des formulaires pour ajouter, modifier, supprimer des éléments de la base de données</small>
    </div>
    
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="forms/categorie/list-categorie.php">Catégorie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="forms/editeur/list-editeur.php">Editeur</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="forms/plateforme/list-plateforme.php">Plateforme</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="forms/utilisateur/list-utilisateur.php">Utilisateur</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="forms/jeux/list-jeux.php">Jeux</a>
        </li>
    </ul>
</section>

<section id="test" class="mt-5">
    <div class="text-left">
        <h3 class="h3">Section de test</h3>
        <small>Naviguer sur les liens ci-dessous pour effectuer les test pour chaque classe correspondante</small>
    </div>
    
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="test/categorie-test.php">Catégorie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="test/editeur-test.php">Editeur</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="test/plateforme-test.php">Plateforme</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="test/utilisateur-test.php">Utilisateur</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="test/jeux-test.php">Jeux</a>
        </li>
    </ul>
</section>

<?php
include 'includes/footer.php';
