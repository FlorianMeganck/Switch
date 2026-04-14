<?php
session_start();
header('Content-Type: application/json');

// Connexion DB
require_once __DIR__ . '/config/db_access.php';

// Récupération du JSON
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
    // Recherche de l'utilisateur
    $stmt = $connexion->prepare("SELECT * FROM users WHERE email = :e");
    $stmt->execute([':e' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($user && password_verify($password, $user['password_hash'])) {
        
        // --- GESTION DE LA SESSION ---
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // --- GESTION DU COOKIE "REMEMBER ME" ---
    if ($remember) {
                $duree = time() + (30 * 24 * 60 * 60); 
                setcookie('remember_user', $user['id'], [
                    'expires' => $duree,
                    'path' => '/',
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]);
            } else {
                setcookie('remember_user', '', time() - 3600, '/');
            }

            // Succès : ce qui est attendu
            echo json_encode([
                'success' => true,
                'user' => [
                    'username' => $user['username'],
                    'id' => $user['id'],
                    'balance' => $user['balance']
                ]
            ]);
            http_response_code(200);
        }

        else {
            // échec de la connexion : identifiants incorrects
            echo json_encode(['success' => false, 'message' => 'Email ou mot de passe incorrect.']);
            http_response_code(401);
        }

    } catch (PDOException $e) {
        //Erreur de la DB
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Une erreur technique est survenue.']);
}