<?php
spl_autoload_register(function($classe){
  require_once '../../classes/'.$classe.'.class.php';
});

include '../../includes/header.php';

require_once('../../includes/db.php');
require_once('../../includes/functions.php');
?>

<h2>Ajouter un nouvel éditeur de jeux</h2>

<div class="row pt-3">
  <div class="col-3 border-right">
    <a href="list-editeur.php" class="link btn btn-primary">Liste des éditeurs</a>
  </div>

  <div class="col-9">
    <form>
        <div class="form-group">
            <label for="nomEditeur">Nom de l'éditeur</label>
            <input type="text" class="form-control" id="nomEditeur">
        </div>

        <div class="form-group">
            <label for="siteEditeur">Site web</label>
            <input type="text" class="form-control" id="siteEditeur">
        </div>

        <button type="submit" name="add-editeur" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<?php
include '../../includes/footer.php';
