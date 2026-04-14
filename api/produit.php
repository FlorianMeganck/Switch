<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

// Sécurité : Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $condition = $_POST['condition'] ?? 'Bon état';
    $seller_id = $_SESSION['user_id'];
    $category_id = $_POST['category_id'] ?? null;
    $new_cat = trim($_POST['new_category_name'] ?? '');

    $image_name = null; 

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
        $file = $_FILES['product_image'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        // Validation simple
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
            echo json_encode(['success' => false, 'message' => 'Format d\'image invalide.']);
            exit;
        }

        $image_name = uniqid() . '.' . $extension; 
        move_uploaded_file($file['tmp_name'], '../uploads/' . $image_name);
    }

    try {
        // 1. LOGIQUE DE LA CATÉGORIE
        if (!empty($new_cat)) {
            // Création d'une nouvelle catégorie si le champ est rempli
            $stmtCat = $connexion->prepare("INSERT INTO categories (name) VALUES (:name)");
            $stmtCat->execute([':name' => $new_cat]);
            $category_id = $connexion->lastInsertId();
        } 
        
        // SÉCURITÉ : Si l'ID est toujours vide, on arrête pour éviter l'erreur SQL
        if (empty($category_id)) {
            echo json_encode(['success' => false, 'message' => 'Veuillez sélectionner ou créer une catégorie.']);
            exit;
        }

        // 2. INSERTION DU PRODUIT
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

    } catch (PDOException $e) {
        // Renvoie l'erreur précise si ça bloque encore
        echo json_encode(['success' => false, 'message' => 'Erreur SQL : ' . $e->getMessage()]);
    }