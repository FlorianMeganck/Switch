<?php
// 1. On inclut la connexion à la DB
include_once __DIR__ . '/config/db_access.php';

// 2. On vérifie si on a bien reçu des données via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 3. On récupère les données du formulaire
    $user = $_POST['username'];
    $mail = $_POST['email'];
    $pass = $_POST['password'];

    // 4. Sécurité : On hache le mot de passe (ne jamais stocker en clair !)
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    // 5. On prépare la requête SQL comme dans le cours 
    // On ne mentionne pas 'id' (auto-incrément) ni 'solde' (valeur par défaut en DB)
    $sql = "INSERT INTO users (username, email, passwordhash) VALUES (:u, :e, :p)";
    $statement = $connexion->prepare($sql);

    // 6. On lie les valeurs et on exécute 
    $statement->execute([
        ':u' => $user,
        ':e' => $mail,
        ':p' => $hash
    ]);

    // 7. On redirige vers l'accueil après l'insertion
    header('Location: index.php');
    exit();
}