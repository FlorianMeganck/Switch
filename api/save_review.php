<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

// 1. Récupération des données envoyées par app.js
$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'] ?? null;
$seller_id = $data['seller_id'] ?? null;
$rating = $data['rating'] ?? null;
$comment = $data['comment'] ?? null;
$author_id = $_SESSION['user_id'] ?? null;

// 2. Vérifications de base
if (!$author_id || !$product_id || !$rating || !$comment || !$seller_id) {
    echo json_encode(['success' => false, 'message' => 'Données incomplètes.']);
    exit;
}

try {
    // 3. SÉCURITÉ : On vérifie si une transaction existe pour cet acheteur et ce produit
    $stmtCheck = $connexion->prepare("SELECT id FROM transactions WHERE product_id = ? AND buyer_id = ?");
    $stmtCheck->execute([$product_id, $author_id]);
    
    if (!$stmtCheck->fetch()) {
        // Si aucune ligne n'est trouvée dans 'transactions', l'avis est refusé
        echo json_encode(['success' => false, 'message' => 'Action non autorisée : achat non trouvé.']);
        exit;
    }

    // 4. SÉCURITÉ : Vérifier si un avis n'a pas déjà été laissé pour ce produit
    $stmtDouble = $connexion->prepare("SELECT id FROM reviews WHERE product_id = ?");
    $stmtDouble->execute([$product_id]);
    if ($stmtDouble->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Vous avez déjà laissé un avis pour cet achat.']);
        exit;
    }

    // 5. Insertion dans la table reviews
    $stmt = $connexion->prepare("INSERT INTO reviews (product_id, author_id, seller_id, rating, comment) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $product_id,
        $author_id,
        $seller_id,
        $rating,
        $comment
    ]);

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'enregistrement : ' . $e->getMessage()]);
}