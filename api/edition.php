<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/db_access.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Action non autorisée.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $cond = $_POST['condition'];
    $cat = $_POST['category_id'];

    try {
        $sql = "UPDATE products SET name = :n, description = :d, price = :p, `condition` = :co, category_id = :ca WHERE id = :id";
        $st = $connexion->prepare($sql);
        $st->execute([
            ':n' => $name, ':d' => $desc, ':p' => $price, ':co' => $cond, ':ca' => $cat, ':id' => $id
        ]);
        
        echo json_encode(['success' => true, 'message' => 'Mise à jour réussie.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur de mise à jour.']);
    }
}