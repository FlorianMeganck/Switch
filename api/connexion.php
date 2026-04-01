<?php
// 1. Configuration de base (Sécurité & Format)
session_start();
header('Content-Type: application/json');

// 2. Connexion DB (Correction du chemin car on est dans /api)
require_once __DIR__ . '/config/db_access.php';

// 3. Vérification que les données arrivent bien
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (!$email || !$password) {
    echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs.']);
    exit;
}

try {
    // 4. Recherche de l'utilisateur
    $stmt = $connexion->prepare("SELECT * FROM users WHERE email = :e");
    $stmt->execute([':e' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 5. Vérification du mot de passe
    if ($user && password_verify($password, $user['password_hash'])) {
        
        // SUCCÈS : On remplit la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // On renvoie juste ce dont vue.js a besoin
        echo json_encode([
            'success' => true,
            'user' => [
                'username' => $user['username'],
                'id' => $user['id']
            ]
        ]);
    } else {
        // ÉCHEC : Identifiants incorrects
        echo json_encode(['success' => false, 'message' => 'Email ou mot de passe incorrect.']);
    }

} catch (PDOException $e) {
    // ERREUR SQL : On renvoie un message propre au lieu de die()
    echo json_encode(['success' => false, 'message' => 'Une erreur technique est survenue.']);
}