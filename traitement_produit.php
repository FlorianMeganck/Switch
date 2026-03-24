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
    
    $category_id = $_POST['category_id']; // L'ID existant
    $new_cat = trim($_POST['new_category_name']); // Le nom potentiel d'une nouvelle catégorie

    try {
        // 🚀 LOGIQUE : Si l'utilisateur a écrit une nouvelle catégorie
        if (!empty($new_cat)) {
            // 1. On l'insère dans la table 'categorys'
            $sqlCat = "INSERT INTO categorys (name) VALUES (:name)";
            $stmtCat = $connexion->prepare($sqlCat);
            $stmtCat->execute([':name' => $new_cat]);
            
            // 2. On récupère l'ID que la DB vient de lui donner
            $category_id = $connexion->lastInsertId();
        }

        // 3. On insère le produit avec le bon category_id (nouveau ou ancien)
        $sql = "INSERT INTO products (name, description, price, `condition`, seller_id, category_id, is_sold) 
                VALUES (:n, :d, :p, :co, :s, :ca, 'non')";
        
        $statement = $connexion->prepare($sql);
        $statement->execute([
            ':n'  => $name,
            ':d'  => $description,
            ':p'  => $price,
            ':co' => $condition,
            ':s'  => $seller_id,
            ':ca' => $category_id
        ]);

        header('Location: index.php?success=added');
        exit();

    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}