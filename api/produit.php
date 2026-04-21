<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

// Vérifier la connexion
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $name = htmlspecialchars($_POST['name']); // Sécurité XSS
    $description = htmlspecialchars($_POST['description']);
    $price = $_POST['price'];
    $condition = $_POST['condition'] ?? 'Bon état';
    $seller_id = $_SESSION['user_id'];
    $category_id = $_POST['category_id'] ?? null;
    $new_cat = trim($_POST['new_category_name'] ?? '');
    
    $image_name = null; 

    // Gestion de l'image si présente
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
        $file = $_FILES['product_image'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Sécurité : vérification du contenu réel
        $check = getimagesize($file['tmp_name']);
        if($check === false) {
            echo json_encode(['success' => false, 'message' => 'Le fichier n\'est pas une image réelle.']);
            exit;
        }
        
        // Validation de l'extension
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
            echo json_encode(['success' => false, 'message' => 'Format d\'image invalide.']);
            exit;
        }

        // Nom unique pour éviter les injections de commande
        $image_name = uniqid() . '.' . $extension; 
        move_uploaded_file($file['tmp_name'], '../uploads/' . $image_name);
    }

    try {
        // Logique de la catégorie
        if (!empty($new_cat)) {
            $stmtCat = $connexion->prepare("INSERT INTO categories (name) VALUES (:name)");
            $stmtCat->execute([':name' => $new_cat]);
            $category_id = $connexion->lastInsertId();
        } 
        
        if (empty($category_id)) {
            echo json_encode(['success' => false, 'message' => 'Veuillez sélectionner ou créer une catégorie.']);
            exit;
        }

        // Insertion du produit avec requêtes préparées
        $sql = "INSERT INTO products (name, description, price, `condition`, seller_id, category_id, image) 
                VALUES (:n, :d, :p, :co, :s, :ca, :img)";

        $statement = $connexion->prepare($sql);
        $statement->execute([
            ':n' => $name,
            ':d' => $description,
            ':p' => $price,
            ':co' => $condition,
            ':s' => $seller_id,
            ':ca' => $category_id,
            ':img' => $image_name
        ]);

        echo json_encode(['success' => true, 'message' => 'Produit ajouté avec succès !']);

    } catch (Throwable $e) { 
        echo json_encode(['success' => false, 'message' => 'Erreur interne : ' . $e->getMessage()]);
    }
}
