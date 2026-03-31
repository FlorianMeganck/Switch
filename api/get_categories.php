<?php
require_once 'db_access.php';
try {
    $query = $connexion->query("SELECT id, name FROM categorys ORDER BY name ASC");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode([]);
}