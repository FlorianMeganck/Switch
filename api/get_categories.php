<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';
try {
    $query = $connexion->query("SELECT id, name FROM categories ORDER BY name ASC");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode([]);
}
