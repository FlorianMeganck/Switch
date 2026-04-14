<?php
require_once __DIR__ . '/config/hsts_security.php';
// On indique au navigateur qu'on renvoie du JSON
header('Content-Type: application/json');

// Connexion à la base de données (située dans le même dossier api/)
require_once __DIR__ . '/config/db_access.php';

try {
    // MODIFICATION : On ajoute seller_id dans la liste pour que Vue.js sache qui a posté l'objet
    $sql = "SELECT p.*, c.name as category_name, u.username as seller_username 
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN users u ON p.seller_id = u.id
            WHERE p.is_sold = 'non' 
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