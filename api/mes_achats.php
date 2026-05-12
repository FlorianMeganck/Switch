<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]); exit;
}

$user_id = $_SESSION['user_id'];
// On récupère les produits achetés avec le nom du vendeur
$stmt = $connexion->prepare(
    "SELECT p.*, t.balance_paid, t.purchase_date, t.buyer_id, u.username as seller_name
    FROM transactions t
    JOIN products p ON t.product_id = p.id
    JOIN users u ON t.seller_id = u.id
    WHERE t.buyer_id = :user_id
    ORDER BY t.purchase_date DESC"
    );

$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
