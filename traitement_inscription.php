<?php
// 1. On active le rapport d'erreurs pour le débug sur le serveur de l'école
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Inclusion de la connexion à la base de données
// On utilise require_once : si le fichier manque, le script s'arrête immédiatement.
require_once __DIR__ . '/config/db_access.php';

// 3. On vérifie que les données arrivent bien via la méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Récupération des données envoyées par le formulaire
    $user = $_POST['username'];
    $mail = $_POST['email'];
    $pass = $_POST['password'];

    // 4. SÉCURITÉ : Hachage du mot de passe
    // On ne stocke jamais le mot de passe en clair.
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    try {
        // 5. Préparation de la requête SQL
        // On utilise des marqueurs (:u, :e, :p) pour contrer les injections SQL.
        $sql = "INSERT INTO users (username, email, password_hash) VALUES (:u, :e, :p)";
        $statement = $connexion->prepare($sql);

        // 6. Exécution de la requête avec les données sécurisées
        $statement->execute([
            ':u' => $user,
            ':e' => $mail,
            ':p' => $hash
        ]);

        // 7. CONNEXION AUTOMATIQUE : On ouvre la session
        session_start();
        
        // On récupère l'ID que la base de données vient de générer (grâce à l'Auto-Incrément)
        $_SESSION['user_id'] = $connexion->lastInsertId();
        $_SESSION['username'] = $user;

        // 8. REDIRECTION : On envoie l'utilisateur vers son profil
        header('Location: profil.php');
        exit();

    } catch (PDOException $e) {
        // En cas d'erreur (ex: email déjà utilisé), on affiche le message pour comprendre
        die("Erreur SQL : " . $e->getMessage());
    }
} else {
    // Si quelqu'un tente d'accéder au fichier sans passer par le formulaire
    header('Location: inscription.php');
    exit();
}