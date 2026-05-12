<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'] ?? null;
$buyer_id = $_SESSION['user_id'] ?? null;

if (!$product_id || !$buyer_id) {
    echo json_encode(['success' => false, 'message' => 'Données manquantes.']);
    exit;
}

try {
    // Récupérer les infos du produit et du vendeur
    $stmtProd = $connexion->prepare("SELECT price, seller_id FROM products WHERE id = :id");
    $stmtProd->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmtProd->execute();
    $product = $stmtProd->fetch();

    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Produit introuvable.']);
        exit;
    }

    $price = $product['price'];
    $seller_id = $product['seller_id'];

    // Vérifier le solde de l'acheteur
    $stmtUser = $connexion->prepare("SELECT balance FROM users WHERE id = :id");
    $stmtUser->bindParam(':id', $buyer_id, PDO::PARAM_INT);
    $stmtUser->execute();
    $user = $stmtUser->fetch();

    if ($user['balance'] < $price) {
        echo json_encode(['success' => false, 'message' => 'Solde insuffisant !']);
        exit;
    }

    // --- DÉBUT DE LA TRANSACTION SQL ---
    $connexion->beginTransaction();

    // Déduire l'argent de l'acheteur
    $stmtBuyer = $connexion->prepare("UPDATE users SET balance = balance - :price WHERE id = :id");
    $stmtBuyer->bindParam(':price', $price, PDO::PARAM_STR, 8);
    $stmtBuyer->bindParam(':id', $buyer_id, PDO::PARAM_INT);
    $stmtBuyer->execute();

    // Créditer le vendeur
    $stmtSeller = $connexion->prepare("UPDATE users SET balance = balance + :price WHERE id = :id");
    $stmtSeller->bindParam(':price', $price, PDO::PARAM_STR, 8);
    $stmtSeller->bindParam(':id', $seller_id, PDO::PARAM_INT);
    $stmtSeller->execute();

    // Créer la transaction officielle
    $stmtTrans = $connexion->prepare("
        INSERT INTO transactions (product_id, buyer_id, seller_id, balance_paid) 
        VALUES (:p_id, :b_id, :s_id, :paid)
    ");
    
    $stmtTrans->bindParam(':p_id', $product_id, PDO::PARAM_INT);
    $stmtTrans->bindParam(':b_id', $buyer_id, PDO::PARAM_INT);
    $stmtTrans->bindParam(':s_id', $seller_id, PDO::PARAM_INT);
    $stmtTrans->bindParam(':paid', $price, PDO::PARAM_STR);
    $stmtTrans->execute();

    $connexion->commit();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    if ($connexion->inTransaction()) $connexion->rollBack();
    echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);
}
