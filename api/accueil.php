<?php
// On indique au navigateur qu'on renvoie du JSON
header('Content-Type: application/json');

// Connexion à la base de données (située dans le même dossier api/)
require_once __DIR__ . '/config/db_access.php';

try {

$sql = "SELECT p.* FROM products p
        LEFT JOIN transactions t ON p.id = t.product_id
        WHERE t.id IS NULL";
            
    $statement = $connexion->query($sql);
    $produits = $statement->fetchAll(PDO::FETCH_ASSOC);

    // On transforme le tableau PHP en JSON
    echo json_encode($produits);

} catch (PDOException $e) {
    // En cas d'erreur, on renvoie le message d'erreur proprement
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}