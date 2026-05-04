<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]); exit;
}

$user_id = $_SESSION['user_id'];

// On récupère les produits achetés avec le nom du vendeur
$stmt = $connexion->prepare("
    SELECT p.*, u.username AS seller_username, t.purchase_date, t.balance_paid, t.buyer_id
    FROM products p
    JOIN transactions t ON p.id = t.product_id
    JOIN users u ON t.seller_id = u.id
    WHERE t.buyer_id = ?
    ORDER BY t.id DESC
");
$stmt->execute([$user_id]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
