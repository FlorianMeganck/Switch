<?php
require_once __DIR__ . '/config/hsts_security.php';
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'] ?? null;
$buyer_id = $_SESSION['user_id'] ?? null;

if (!$buyer_id || !$product_id) {
    echo json_encode(['success' => false, 'message' => 'Données manquantes.']); exit;
}

try {
    // 1. On récupère les infos de l'objet
    $stmt = $connexion->prepare("SELECT price, seller_id FROM products WHERE id = ? AND is_sold = 'non'");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // SÉCURITÉ : On vérifie que le produit existe ET qu'il a un prix/vendeur
    if (!$product || $product['price'] === null || !$product['seller_id']) {
        echo json_encode(['success' => false, 'message' => 'Erreur : Produit invalide ou sans prix.']); exit;
    }

    // 2. Vérification du solde de l'acheteur
    $stmtBuyer = $connexion->prepare("SELECT balance FROM users WHERE id = ?");
    $stmtBuyer->execute([$buyer_id]);
    $buyer = $stmtBuyer->fetch(PDO::FETCH_ASSOC);
    
    // On force la balance à 0 si elle est NULL
    $buyerBalance = $buyer['balance'] ?? 0;

    if ($buyerBalance < $product['price']) {
        echo json_encode(['success' => false, 'message' => 'Solde insuffisant.']); exit;
    }

    $connexion->beginTransaction();

    // A. Débit acheteur
    $stmtA = $connexion->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
    $stmtA->execute([$product['price'], $buyer_id]);

    // B. Crédit vendeur
    $stmtV = $connexion->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
    $stmtV->execute([$product['price'], $product['seller_id']]);

    // C. Historique (On utilise bien les données récupérées à l'étape 1)
    $stmtT = $connexion->prepare("INSERT INTO transactions (product_id, buyer_id, seller_id, balance_paid) VALUES (?, ?, ?, ?)");
    $stmtT->execute([$product_id, $buyer_id, $product['seller_id'], $product['price']]);

    // D. Statut vendu
    $stmtM = $connexion->prepare("UPDATE products SET is_sold = 'oui', buyer_id = ? WHERE id = ?");
    $stmtM->execute([$buyer_id, $product_id]);

    $connexion->commit();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    if ($connexion->inTransaction()) $connexion->rollBack();
    echo json_encode(['success' => false, 'message' => 'Erreur technique.']);
}