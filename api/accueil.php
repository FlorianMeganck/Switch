<?php
// On indique au navigateur qu'on renvoie du JSON
header('Content-Type: application/json');

// Connexion à la base de données (située dans le même dossier api/)
require_once __DIR__ . '/config/db_access.php';

try {

$sql = "SELECT p.*, u.username AS seller_username, c.name AS category_name
            FROM products p
            JOIN users u ON p.seller_id = u.id
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN transactions t ON p.id = t.product_id
            WHERE t.id IS NULL
            ORDER BY p.id DESC";
            
    $statement = $connexion->query($sql);
    $produits = $statement->fetchAll(PDO::FETCH_ASSOC);

    // On transforme le tableau PHP en JSON
    echo json_encode($produits);

} catch (PDOException $e) {
    // En cas d'erreur, on renvoie le message d'erreur proprement
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}