<?php
require_once __DIR__ . '/config/security.php';
require_once __DIR__ . '/config/db_access.php';

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'] ?? null;
$buyer_id = $_SESSION['user_id'] ?? null;

if (!$product_id || !$buyer_id) {
    echo json_encode(['success' => false, 'message' => 'Données manquantes.']);
    exit;
}

try {
    // 2. Récupérer les infos du produit et du vendeur
    $stmtProd = $connexion->prepare("SELECT price, seller_id FROM products WHERE id = ?");
    $stmtProd->execute([$product_id]);
    $product = $stmtProd->fetch();

    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Produit introuvable.']);
        exit;
    }

    $price = $product['price'];
    $seller_id = $product['seller_id'];

    // 3. Vérifier le solde de l'acheteur
    $stmtUser = $connexion->prepare("SELECT balance FROM users WHERE id = ?");
    $stmtUser->execute([$buyer_id]);
    $user = $stmtUser->fetch();

    if ($user['balance'] < $price) {
        echo json_encode(['success' => false, 'message' => 'Solde insuffisant !']);
        exit;
    }

    // --- DÉBUT DE LA TRANSACTION SQL ---
    $connexion->beginTransaction();

    // 4. Déduire l'argent de l'acheteur
    $connexion->prepare("UPDATE users SET balance = balance - ? WHERE id = ?")->execute([$price, $buyer_id]);

    // 5. Créditer le vendeur
    $connexion->prepare("UPDATE users SET balance = balance + ? WHERE id = ?")->execute([$price, $seller_id]);

    // 6. CRÉER LA TRANSACTION OFFICIELLE
    // C'est cette ligne qui remplace l'ancien "UPDATE products"
    $stmtTrans = $connexion->prepare("
        INSERT INTO transactions (product_id, buyer_id, seller_id, balance_paid) 
        VALUES (?, ?, ?, ?)
    ");
    $stmtTrans->execute([$product_id, $buyer_id, $seller_id, $price]);

    $connexion->commit();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    if ($connexion->inTransaction()) $connexion->rollBack();
    echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);
}