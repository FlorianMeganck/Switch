<?php
session_start(); // On regarde si une session existe
header('Content-Type: application/json');

if (isset($_SESSION['user_id'])) {
    // On renvoie les infos si l'étudiant est déjà connecté
    echo json_encode([
        'connected' => true,
        'user' => [
            'username' => $_SESSION['username'], 
            'id' => $_SESSION['user_id']
        ]
    ]);
} else {
    echo json_encode(['connected' => false]);
}