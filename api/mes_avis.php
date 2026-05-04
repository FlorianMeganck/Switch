<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) { echo json_encode([]); exit; }

// On récupère l'avis avec le nom du produit associé
$stmt = $connexion->prepare("
    SELECT r.*, p.name as product_name 
    FROM reviews r 
    JOIN products p ON r.product_id = p.id 
    WHERE r.author_id = ? 
    ORDER BY r.id DESC
");
$stmt->execute([$user_id]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
