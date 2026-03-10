<?php
// On inclut ton fichier de config (adapte le chemin si besoin)
include_once 'config/db_access.php';

// On vérifie si la variable $connexion existe et fonctionne
if (isset($connexion)) {
    echo "<h1>Bravo !</h1>";
    echo "<p>La connexion à la base de données est active. La variable <b>\$connexion</b> est prête à l'emploi.</p>";
} else {
    echo "<h1>Oups...</h1>";
    echo "<p>La connexion a échoué. Vérifie tes identifiants dans db_access.php.</p>";
}