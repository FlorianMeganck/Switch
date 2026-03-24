<?php
session_start();
require_once __DIR__ . '/config/db_access.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $cond = $_POST['condition'];
    $cat = $_POST['category_id'];

    try {
        $sql = "UPDATE products SET name = :n, description = :d, price = :p, `condition` = :co, category_id = :ca WHERE id = :id";
        $st = $connexion->prepare($sql);
        $st->execute([
            ':n' => $name, ':d' => $desc, ':p' => $price, ':co' => $cond, ':ca' => $cat, ':id' => $id
        ]);
        header('Location: index.php?status=updated');
    } catch (PDOException $e) {
        die("Erreur de mise à jour : " . $e->getMessage());
    }
}