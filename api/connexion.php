<?php
// 1. Configuration de base (Sécurité & Format)
session_start();
header('Content-Type: application/json');

// 2. Connexion DB
require_once __DIR__ . '/config/db_access.php';

// 3. Récupération du JSON
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// On récupère les données depuis le tableau $data
$email = $data['email'] ?? null;
$password = $data['password'] ?? null;
$remember = $data['remember'] ?? false; // On récupère l'état de la case à cocher

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
        
        // --- GESTION DE LA SESSION ---
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // --- GESTION DU COOKIE "REMEMBER ME" ---
        if ($remember) {
            // On calcule la durée sur 30 jours
            $duree = time() + (30 * 24 * 60 * 60); 

            // On stocke l'ID de l'utilisateur dans un cookie sécurisé
            setcookie('remember_user', $user['id'], [
                'expires' => $duree,
                'path' => '/',
                'httponly' => true, // Sécurité contre le vol de cookie en JS
                'samesite' => 'Lax'
            ]);
        }

        // 6. Succès : ce qui est attendu
        echo json_encode([
            'success' => true,
            'user' => [
                'username' => $user['username'],
                'id' => $user['id']
            ]
        ]);
        http_response_code(200);

    } else {
        // échec de la connexion : identifiants incorrects
        echo json_encode(['success' => false, 'message' => 'Email ou mot de passe incorrect.']);
        http_response_code(401);
    }

} catch (PDOException $e) {
    //Erreur de la DB
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Une erreur technique est survenue.']);
}