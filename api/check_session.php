<?php
require_once __DIR__ . '/config/security.php';
header('Content-Type: application/json');
require_once __DIR__ . '/config/db_access.php';

$response = ['connected' => false, 'user' => null];

if (isset($_SESSION['user_id'])) {
    $stmt = $connexion->prepare("SELECT id, username, balance FROM users WHERE id = :id");
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $response = [
            'connected' => true,
            'user' => [
                'username' => $user['username'], 
                'id' => $user['id'],
                'balance' => $user['balance'] // Ajout du solde
            ]
        ];
    }
}
else if (isset($_COOKIE['remember_user'])) {
    $user_id = $_COOKIE['remember_user']; // Dans connexion.php, on a stocké l'ID dans ce cookie

    try {
        // On vérifie que cet utilisateur existe toujours bien en base de données
        $stmt = $connexion->prepare("SELECT id, username FROM users WHERE id = :id");
        $stmt->execute([':id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Succès : Le cookie est valide, on recrée la session automatiquement
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            $response = [
                'connected' => true,
                'user' => [
                    'username' => $user['username'],
                    'id' => $user['id']
                ]
            ];
        }
    } catch (PDOException $e) {
        // En cas d'erreur DB on reste sur 'connected' => false
    }
}

// Envoi de la réponse à l'app.js
echo json_encode($response);
exit;