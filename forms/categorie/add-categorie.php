<?php
spl_autoload_register(function($classe){
  require_once '../../classes/'.$classe.'.class.php';
});

include '../../includes/header.php';

require_once('../../includes/db.php');
require_once('../../includes/functions.php');
?>

<h2>Ajouter une nouvelle catégorie de jeux</h2>

<div class="row pt-3">
  <div class="col-3 border-right">
    <a href="list-categorie.php" class="link btn btn-primary">Liste des catégorie</a>
  </div>

  <div class="col-9">
    <form>
        <div class="form-group">
            <label for="nomCategorie">Nom de la catégorie</label>
            <input type="text" class="form-control" id="nomCategorie">
            <small>Action, RPG, Sport, etc...</small>
        </div>
        <button type="submit" name="add-categorie" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<?php
include '../../includes/footer.php';
