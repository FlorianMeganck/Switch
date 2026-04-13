<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]); exit;
}

$user_id = $_SESSION['user_id'];

// On récupère les produits achetés avec le nom du vendeur
$stmt = $connexion->prepare("
    SELECT p.*, u.username as seller_username 
    FROM products p 
    JOIN users u ON p.seller_id = u.id 
    WHERE p.buyer_id = ? 
    ORDER BY p.id DESC
");
$stmt->execute([$user_id]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));