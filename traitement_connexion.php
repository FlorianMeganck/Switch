<?php
session_start(); // On démarre la session pour pouvoir connecter l'utilisateur
require_once __DIR__ . '/config/db_access.php'; // Connexion DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['email'];
    $pass = $_POST['password'];

    try {
        // 1. On cherche l'utilisateur par son email
        $sql = "SELECT * FROM users WHERE email = :e";
        $statement = $connexion->prepare($sql);
        $statement->execute([':e' => $mail]);
        $user = $statement->fetch(); // On récupère la ligne correspondante

        // 2. On vérifie si l'utilisateur existe ET si le mot de passe est bon
        if ($user && password_verify($pass, $user['password_hash'])) {
            
            // 3. SUCCÈS : On crée les variables de session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirection vers le profil
            header('Location: profil.php');
            exit();
        } else {
            // 4. ÉCHEC : On renvoie à la page de connexion avec un message d'erreur
            header('Location: connexion.php?error=1');
            exit();
        }

    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}