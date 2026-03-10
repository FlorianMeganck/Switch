<?php
define('USER', 'hh76ic64hcii');
define('PASSWD', 't7=h1h#4hh');
define('SERVER', 'localhost');
define('BASE', 'ebus2_projet05_siii57');

// le seul endroit où je vais dire le type de base de données SQL que j'utilise
$dsn = 'mysql:host=' . SERVER . ';dbname=' . BASE;

try {
    // créer la connexion  
    $connexion = new PDO($dsn, USER, PASSWD);
} catch (PDOException $e) {
    echo 'Échec de la connexion : ' . $e->getMessage();
    exit();
}

// si tout se passe bien alors, on a à disposition la variable $connexion