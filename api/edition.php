<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Action non autorisée.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $cond = $_POST['condition'];
    $cat = $_POST['category_id'];
    $new_cat = trim($_POST['new_category_name'] ?? '');

    // SÉCURITÉ : Si JS a envoyé le mot "undefined" en texte, on l'ignore
    if ($new_cat === 'undefined' || empty($new_cat)) {
        $new_cat = ''; 
    }

    try {
        // La logique de création ne se déclenche QUE si $new_cat est vraiment rempli
        if (!empty($new_cat)) {
            $stmtCat = $connexion->prepare("INSERT INTO categories (name) VALUES (:name)");
            $stmtCat->execute([':name' => $new_cat]);
            $cat = $connexion->lastInsertId();
        }

        // Gestion de la nouvelle photo (si envoyée)
        $image_sql = "";
        $params = [':n' => $name, ':d' => $desc, ':p' => $price, ':co' => $cond, ':ca' => $cat, ':id' => $id];

        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
            $file = $_FILES['product_image'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $image_name = uniqid() . '.' . $ext;
            
            // On sort de api/ vers uploads/
            if (move_uploaded_file($file['tmp_name'], '../uploads/' . $image_name)) {
                $image_sql = ", image = :img";
                $params[':img'] = $image_name;
            }
        }

        // Mise à jour SQL
        $sql = "UPDATE products SET name = :n, description = :d, price = :p, `condition` = :co, category_id = :ca $image_sql WHERE id = :id";
        $st = $connexion->prepare($sql);
        $st->execute($params);
        
        echo json_encode(['success' => true, 'message' => 'Mise à jour réussie.']);
        } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Erreur SQL : ' . $e->getMessage()]);
            }
}