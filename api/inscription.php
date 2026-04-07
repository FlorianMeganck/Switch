<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/config/db_access.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $user = $data['username'] ?? null;  //lecture du json comme dans connexion
    $mail = $data['email'] ?? null;
    $pass = $data['password'] ?? null;

    if (!$user || !$mail || !$pass) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs sont obligatoires.']);
        exit;
    }

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    try {
        // Vérification si l'email existe déjà
        $check = $connexion->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$mail]);
        
        if ($check->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Cet email est déjà utilisé.']);
            exit;
        }

        // Insertion
        $sql = "INSERT INTO users (username, email, password_hash) VALUES (:u, :e, :p)";
        $statement = $connexion->prepare($sql);
        $statement->execute([':u' => $user, ':e' => $mail, ':p' => $hash]);

        $_SESSION['user_id'] = $connexion->lastInsertId();
        $_SESSION['username'] = $user;

        echo json_encode([
            'success' => true, 
            'user' => ['username' => $user, 'id' => $_SESSION['user_id']]
        ]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => "Erreur lors de l'inscription technique."]);
    }
}