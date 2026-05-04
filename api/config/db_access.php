<?php
$host = 'localhost';
$db   = 'ebus2_projet05_siii57';
$user = 'hh76ic64hcii';
$pass = 't7=h1h#4hh';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Les options de sécurité et d'optimisation
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active les erreurs propres
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Tableaux associatifs uniquement
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Sécurité injection SQL
];

try {
    $connexion = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // En cas d'échec, on arrête proprement sans exposer tes identifiants
    exit("Erreur technique de connexion.");
}
