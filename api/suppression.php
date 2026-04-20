<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Action non autorisée.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id']; // Sécurité : on vérifie que c'est bien l'annonce du user

    try {
        // On ne supprime que si l'ID produit et l'ID vendeur correspondent
        $sql = "DELETE FROM products WHERE id = :pid AND seller_id = :sid";
        $statement = $connexion->prepare($sql);
        $statement->execute([
            ':pid' => $product_id,
            ':sid' => $user_id
        ]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression.']);
    }
}