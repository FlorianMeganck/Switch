<?php
session_start();
require_once __DIR__ . '/config/db_access.php';

if (!isset($_SESSION['user_id'])) { header('Location: connexion.php'); exit(); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $condition = $_POST['condition'];
    $seller_id = $_SESSION['user_id'];
    $category_id = $_POST['category_id'];
    $new_cat = trim($_POST['new_category_name']);

    // --- GESTION DE L'IMAGE ---
    $image_name = null; // Par défaut, pas d'image

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
        $upload_dir = 'uploads/';
        
        // On crée un nom unique pour éviter que deux photos "image.jpg" s'écrasent
        $extension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid() . '.' . $extension; 
        $target_path = $upload_dir . $image_name;

        // On déplace le fichier du dossier temporaire vers ton dossier uploads
        move_uploaded_file($_FILES['product_image']['tmp_name'], $target_path);
    }

    try {
        // Logique catégorie (que tu as déjà)
        if (!empty($new_cat)) {
            $stmtCat = $connexion->prepare("INSERT INTO categorys (name) VALUES (:name)");
            $stmtCat->execute([':name' => $new_cat]);
            $category_id = $connexion->lastInsertId();
        }

        // INSERTION DU PRODUIT (On ajoute la colonne 'image' ici)
        $sql = "INSERT INTO products (name, description, price, `condition`, seller_id, category_id, is_sold, image) 
                VALUES (:n, :d, :p, :co, :s, :ca, 'non', :img)";
        
        $statement = $connexion->prepare($sql);
        $statement->execute([
            ':n'  => $name,
            ':d'  => $description,
            ':p'  => $price,
            ':co' => $condition,
            ':s'  => $seller_id,
            ':ca' => $category_id,
            ':img' => $image_name // On enregistre le nom du fichier
        ]);

        header('Location: index.php?success=added');
        exit();

    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}