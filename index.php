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
        <h3 class="h3">Section de gestion avec les formulaires</h3>
        <p>Naviguer sur les liens ci-dessous pour effectuer les test pour chaque classe correspondante</p>
    </div>
    
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="categorie-tab" data-toggle="tab" href="#categorie" role="tab" aria-controls="categorie" aria-selected="true">Catégorie</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="editeur-tab" data-toggle="tab" href="#editeur" role="tab" aria-controls="editeur" aria-selected="false">Editeur</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="plateforme-tab" data-toggle="tab" href="#plateforme" role="tab" aria-controls="plateforme" aria-selected="false">Plateforme</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="utilisateur-tab" data-toggle="tab" href="#utilisateur" role="tab" aria-controls="utilisateur" aria-selected="false">Utilisateur</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="jeux-tab" data-toggle="tab" href="#jeux" role="tab" aria-controls="jeux" aria-selected="false">Jeux</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane py-5 px-3 bg-light fade show active" id="categorie" role="tabpanel" aria-labelledby="categorie-tab">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="test/categorie-test.php" class="link">Get</a></li>
                <li class="list-group-item"><a href="test/categorie-test.php" class="link">Add</a></li>
                <li class="list-group-item"><a href="test/categorie-test.php" class="link">Update</a></li>
                <li class="list-group-item"><a href="test/categorie-test.php" class="link">Delete</a></li>
            </ul>
        </div>
    
        <div class="tab-pane py-5 px-3 bg-light fade" id="editeur" role="tabpanel" aria-labelledby="editeur-tab">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="test/editeur-test.php" class="link">Get</a></li>
                <li class="list-group-item"><a href="test/editeur-test.php" class="link">Add</a></li>
                <li class="list-group-item"><a href="test/editeur-test.php" class="link">Update</a></li>
                <li class="list-group-item"><a href="test/editeur-test.php" class="link">Delete</a></li>
            </ul>
        </div>
    
        <div class="tab-pane py-5 px-3 bg-light fade" id="plateforme" role="tabpanel" aria-labelledby="plateforme-tab">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="test/plateforme-test.php" class="link">Get</a></li>
                <li class="list-group-item"><a href="test/plateforme-test.php" class="link">Add</a></li>
                <li class="list-group-item"><a href="test/plateforme-test.php" class="link">Update</a></li>
                <li class="list-group-item"><a href="test/plateforme-test.php" class="link">Delete</a></li>
            </ul>
        </div>
    
        <div class="tab-pane py-5 px-3 bg-light fade" id="utilisateur" role="tabpanel" aria-labelledby="utilisateur-tab">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="test/utilisateur-test.php" class="link">Get</a></li>
                <li class="list-group-item"><a href="test/utilisateur-test.php" class="link">Add</a></li>
                <li class="list-group-item"><a href="test/utilisateur-test.php" class="link">Update</a></li>
                <li class="list-group-item"><a href="test/utilisateur-test.php" class="link">Delete</a></li>
            </ul>
        </div>
    
        <div class="tab-pane py-5 px-3 bg-light fade" id="jeux" role="tabpanel" aria-labelledby="jeux-tab">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="test/jeux-test.php" class="link">Get</a></li>
                <li class="list-group-item"><a href="test/jeux-test.php" class="link">Add</a></li>
                <li class="list-group-item"><a href="test/jeux-test.php" class="link">Update</a></li>
                <li class="list-group-item"><a href="test/jeux-test.php" class="link">Delete</a></li>
            </ul>
        </div>
    </div>
</section>

<section id="test" class="mt-5">
    <div class="text-left">
        <h3 class="h3">Section de test</h3>
        <p>Naviguer sur les liens ci-dessous pour effectuer les test pour chaque classe correspondante</p>
    </div>
    
    <ul class="nav nav-tabs" id="myTab-test" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="categorie-tab-test" data-toggle="tab" href="#categorie-test" role="tab" aria-controls="categorie" aria-selected="true">Catégorie</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="editeur-tab-test" data-toggle="tab" href="#editeur-test" role="tab" aria-controls="editeur" aria-selected="false">Editeur</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="plateforme-tab-test" data-toggle="tab" href="#plateforme-test" role="tab" aria-controls="plateforme" aria-selected="false">Plateforme</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="utilisateur-tab-test" data-toggle="tab" href="#utilisateur-test" role="tab" aria-controls="utilisateur" aria-selected="false">Utilisateur</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="jeux-tab-test" data-toggle="tab" href="#jeux-test" role="tab" aria-controls="jeux" aria-selected="false">Jeux</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane py-5 px-3 bg-light fade show active" id="categorie-test" role="tabpanel" aria-labelledby="categorie-tab">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="test/categorie-test.php" class="link">Get</a></li>
                <li class="list-group-item"><a href="test/categorie-test.php" class="link">Add</a></li>
                <li class="list-group-item"><a href="test/categorie-test.php" class="link">Update</a></li>
                <li class="list-group-item"><a href="test/categorie-test.php" class="link">Delete</a></li>
            </ul>
        </div>
    
        <div class="tab-pane py-5 px-3 bg-light fade" id="editeur-test" role="tabpanel" aria-labelledby="editeur-tab">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="test/editeur-test.php" class="link">Get</a></li>
                <li class="list-group-item"><a href="test/editeur-test.php" class="link">Add</a></li>
                <li class="list-group-item"><a href="test/editeur-test.php" class="link">Update</a></li>
                <li class="list-group-item"><a href="test/editeur-test.php" class="link">Delete</a></li>
            </ul>
        </div>
    
        <div class="tab-pane py-5 px-3 bg-light fade" id="plateforme-test" role="tabpanel" aria-labelledby="plateforme-tab">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="test/plateforme-test.php" class="link">Get</a></li>
                <li class="list-group-item"><a href="forms/add-plateforme.php" class="link">Add</a></li>
                <li class="list-group-item"><a href="forms/update-plateforme.php" class="link">Update</a></li>
                <li class="list-group-item"><a href="test/plateforme-test.php" class="link">Delete</a></li>
            </ul>
        </div>
    
        <div class="tab-pane py-5 px-3 bg-light fade" id="utilisateur-test" role="tabpanel" aria-labelledby="utilisateur-tab">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="test/utilisateur-test.php" class="link">Get</a></li>
                <li class="list-group-item"><a href="test/utilisateur-test.php" class="link">Add</a></li>
                <li class="list-group-item"><a href="test/utilisateur-test.php" class="link">Update</a></li>
                <li class="list-group-item"><a href="test/utilisateur-test.php" class="link">Delete</a></li>
            </ul>
        </div>
    
        <div class="tab-pane py-5 px-3 bg-light fade" id="jeux-test" role="tabpanel" aria-labelledby="jeux-tab">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><a href="test/jeux-test.php" class="link">Get</a></li>
                <li class="list-group-item"><a href="test/jeux-test.php" class="link">Add</a></li>
                <li class="list-group-item"><a href="test/jeux-test.php" class="link">Update</a></li>
                <li class="list-group-item"><a href="test/jeux-test.php" class="link">Delete</a></li>
            </ul>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
