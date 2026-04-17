<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

try {

$sql = "SELECT p.*, u.username as seller_username, c.name as category_name
        FROM products p
        JOIN users u on p.seller_id = u.id
        LEFT JOIN categories c on p.category_id = c.id
        LEFT JOIN transactions t on p.id = t.product_id
        WHERE t.id is null
        ORDER BY p.id desc";
            
    $statement = $connexion->query($sql);
    $produits = $statement->fetchAll(PDO::FETCH_ASSOC);

    // On transforme le tableau PHP en JSON
    echo json_encode($produits);

} catch (PDOException $e) {
    // En cas d'erreur, on renvoie le message d'erreur
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}