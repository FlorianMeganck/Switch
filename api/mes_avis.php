<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) { echo json_encode([]); exit; }

// On récupère l'avis avec le nom du produit associé
$stmt = $connexion->prepare(
    "SELECT r.id, r.product_id, r.author_id, r.seller_id, r.rating, r.comment, p.name as product_name
    FROM reviews r
    JOIN products p ON r.product_id = p.id
    WHERE r.author_id = :author_id
    ORDER BY r.review_date DESC"
    );

$stmt->bindParam(':author_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
