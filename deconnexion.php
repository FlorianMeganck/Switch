<?php
// 1. On doit démarrer la session pour pouvoir la manipuler
session_start();

// 2. On vide le tableau des variables de session
$_SESSION = array();

// 3. On détruit la session côté serveur
session_destroy();

// 4. On redirige l'utilisateur vers l'accueil
header('Location: index.php');
exit();
?>