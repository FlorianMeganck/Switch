<?php
session_start(); // On récupère la session en cours

// On supprime toutes les variables de session
$_SESSION = array();

// On détruit la session côté serveur
session_destroy();

// On renvoie une réponse JSON positive pour que Vue.js sache que c'est fait
echo json_encode(['success' => true]);
exit;
?>