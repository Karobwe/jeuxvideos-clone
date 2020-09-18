<?php

function pre_var_dump(...$args) {
  echo '<pre class="bg-dark text-white p-3">';
  var_dump($args);
  echo '</pre>';
}

/**
 * Affiche un message dans une div possédant les classes alerts de Bootstrap
 * 
 * @param string $message Contenu à afficher
 * @param string $type Type d'alert souhaiter (success, info, warning, danger, etc)
 */
function bootstrap_alert(string $message, string $type = 'info') {
  if(!in_array($type, array('success', 'warning', 'danger', 'light', 'dark', 'info'))) {
    $type = 'info';
  }

  echo '<div class="alert alert-' . $type . '">' . $message . '</div>';
}
