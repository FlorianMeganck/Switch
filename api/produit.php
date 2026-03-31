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

    // --- GESTION DE L'IMAGE (SÉCURISÉE) ---
    $image_name = null; 

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
        $file = $_FILES['product_image'];
        
        // 1. Paramètres de sécurité
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
        $allowed_mimes = ['image/jpeg', 'image/png', 'image/webp'];
        $max_size = 2 * 1024 * 1024; // 2 Mo

        // 2. Vérification de l'extension
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // 3. Vérification du MIME Type (le fameux "mimptimp")
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        // 4. Test de validation
        if (!in_array($extension, $allowed_extensions)) {
            die("Erreur : Extension ." . $extension . " non autorisée.");
        }
        if (!in_array($mime_type, $allowed_mimes)) {
            die("Erreur : Le fichier n'est pas une image valide (MIME non reconnu).");
        }
        if ($file['size'] > $max_size) {
            die("Erreur : L'image est trop lourde (max 2Mo).");
        }

        // 5. Si tout est OK, upload
        $upload_dir = 'uploads/';
        $image_name = uniqid() . '.' . $extension; 
        $target_path = $upload_dir . $image_name;

        if (!move_uploaded_file($file['tmp_name'], $target_path)) {
            die("Erreur lors du transfert de l'image.");
        }
    }
    // --- FIN GESTION DE L'IMAGE ---

    try {
        // Logique catégorie
        if (!empty($new_cat)) {
            $stmtCat = $connexion->prepare("INSERT INTO categorys (name) VALUES (:name)");
            $stmtCat->execute([':name' => $new_cat]);
            $category_id = $connexion->lastInsertId();
        }

        // INSERTION DU PRODUIT
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
            ':img' => $image_name 
        ]);

        header('Location: index.php?success=added'); 
        exit();

    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}