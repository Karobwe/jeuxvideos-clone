<?php
spl_autoload_register(function($classe){
  require_once 'classes/'.$classe.'.class.php';
});

include 'includes/header.php';

include 'includes/footer.php';
