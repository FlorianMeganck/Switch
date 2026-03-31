<?php
// On indique au navigateur qu'on renvoie du JSON
header('Content-Type: application/json');

// Connexion à la base de données (située dans le même dossier api/)
require_once 'db_access.php';

try {
    // MODIFICATION : On ajoute seller_id dans la liste pour que Vue.js sache qui a posté l'objet
    $sql = "SELECT id, name, price, `condition`, image, seller_id 
            FROM products 
            WHERE is_sold = 'non' 
            ORDER BY id DESC 
            LIMIT 4";
            
    $statement = $connexion->query($sql);
    $produits = $statement->fetchAll(PDO::FETCH_ASSOC);

    // On transforme le tableau PHP en JSON
    echo json_encode($produits);

} catch (PDOException $e) {
    // En cas d'erreur, on renvoie le message d'erreur proprement
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}