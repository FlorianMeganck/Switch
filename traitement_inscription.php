<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// On utilise require_once : si le fichier n'est pas trouvé, le script s'arrête net.
// On utilise __DIR__ pour être sûr du chemin sur le serveur.
require_once __DIR__ . '/config/db_access.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 2. Récupération des données du formulaire
    $user = $_POST['username'];
    $mail = $_POST['email'];
    $pass = $_POST['password'];

    // 3. Hachage du mot de passe pour la sécurité
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    try {
        // 4. La requête SQL corrigée avec l'underscore (_)
        // On prépare la requête pour éviter les injections SQL
        $sql = "INSERT INTO users (username, email, password_hash) VALUES (:u, :e, :p)";
        $statement = $connexion->prepare($sql);

        // 5. On envoie les données
        $statement->execute([
            ':u' => $user,
            ':e' => $mail,
            ':p' => $hash
        ]);

        // 6. Succès ! On redirige vers l'accueil
        header('Location: index.php');
        exit();

    } catch (PDOException $e) {
        // Si ça rate encore, ce message nous dira exactement pourquoi
        die("Erreur SQL sur le serveur : " . $e->getMessage());
    }
}