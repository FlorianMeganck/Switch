<?php
session_start();
header('Content-Type: application/json');

// 1. On utilise le chemin relatif direct
require_once 'db_access.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? null;
    $mail = $_POST['email'] ?? null;
    $pass = $_POST['password'] ?? null;

    if (!$user || !$mail || !$pass) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs sont obligatoires.']);
        exit;
    }

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    try {
        // 2. Vérification si l'email existe déjà
        $check = $connexion->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$mail]);
        
        if ($check->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Cet email est déjà utilisé.']);
            exit;
        }

        // 3. Insertion (Vérifie bien que tes colonnes s'appellent username, email, password_hash)
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
        // CORRECTION ICI : On utilise des guillemets doubles pour éviter le bug de l'apostrophe
        echo json_encode(['success' => false, 'message' => "Erreur lors de l'inscription technique."]);
    }
}