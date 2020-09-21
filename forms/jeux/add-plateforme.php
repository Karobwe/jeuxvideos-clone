<?php
spl_autoload_register(function($classe){
  require_once '../../classes/'.$classe.'.class.php';
});

include '../../includes/header.php';

require_once('../../includes/db.php');
require_once('../../includes/functions.php');

$plateformeManager = new PlateformeManager($pdo);

?>

<h2>Ajouter une nouvelle plateforme</h2>

<div class="row pt-3">
  <div class="col-3 border-right">
    <a href="list-utilisateur.php" class="link btn btn-primary">Liste des plateforme</a>
  </div>

  <div class="col-9">
    <form>
        <div class="form-group">
            <label for="pseudo">Nom</label>
            <input type="text" class="form-control" name="nomPlateforme" id="nomPlateforme">
        </div>
        <button type="submit" name="add-utilisateur" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<?php
include '../../includes/footer.php';
