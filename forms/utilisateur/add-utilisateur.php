<?php
spl_autoload_register(function($classe){
  require_once '../../classes/'.$classe.'.class.php';
});

include '../../includes/header.php';

require_once('../../includes/db.php');
require_once('../../includes/functions.php');

$utilisateurManager = new UtilisateurManager($pdo);

?>

<h2>Ajouter un nouvel utilisateur</h2>

<div class="row pt-3">
  <div class="col-3 border-right">
    <a href="list-utilisateur.php" class="link btn btn-primary">Liste des utilisateur</a>
  </div>

  <div class="col-9">
    <form>
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" name="pseudo" id="pseudo">
        </div>

        <div class="form-group">
            <label for="pseudo">Email</label>
            <input type="text" class="form-control" name="email" id="email">
        </div>

        <div class="form-group">
            <label for="pseudo">Password</label>
            <input type="text" class="form-control" name="password" id="pseudo">
        </div>

        <div class="form-group">
            <label for="statut">Statut</label>
            <select class="custom-select form-control" id="statut" name="statut">
                <option selected disabled>Choisir...</option>
                <?php foreach($utilisateurManager->getStatutValues() as $key => $value): ?>
                    <option value="<?php echo $key?>"><?php echo $value?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="add-utilisateur" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<?php
include '../../includes/footer.php';
