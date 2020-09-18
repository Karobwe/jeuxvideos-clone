<?php

spl_autoload_register(function($classe){
    require_once 'classes/'.$classe.'.class.php';
});

require_once '../includes/db.php';
require_once '../includes/functions.php';

include '../includes/header.php';
?>

<h1 class="h1">Test de la classe <strong>Categorie</strong> et son manager</h1>
<!-- Faire les test ici -->

<?php
include '../includes/footer.php';