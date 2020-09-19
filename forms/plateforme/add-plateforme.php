<?php
spl_autoload_register(function($classe){
  require_once '../../classes/'.$classe.'.class.php';
});

include '../../includes/header.php';

require_once('../../includes/db.php');
require_once('../../includes/functions.php');
?>

<h2>Ajouter une nouvelle plateforme de jeux</h2>

<div class="row pt-3">
  <div class="col-3 border-right">
    <a href="list-plateforme.php" class="link btn btn-primary">Liste des plateformes</a>
  </div>

  <div class="col-9">
    <form>
        <div class="form-group">
            <label for="nomPlateforme">Nom de la platforme</label>
            <input type="text" class="form-control" id="nomPlateforme">
            <small>Exemple: PS4, PS5, Xbox One, Xbox 3620,  Wii</small>
        </div>
        <button type="submit" name="add-plateforme" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<?php
include '../../includes/footer.php';
