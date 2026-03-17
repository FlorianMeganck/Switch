<?php
session_start();
require_once __DIR__ . '/config/db_access.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    
    // On récupère l'ID du vendeur directement depuis la SESSION (Sécurité !)
    $vendeur = $_SESSION['user_id'];
    $nom = $_POST['nom'];
    $desc = $_POST['description'];
    $prix = $_POST['prix'];
    $etat = $_POST['etat'];

    try {
        // On insère dans 'products' en utilisant tes colonnes exactes
        $sql = "INSERT INTO products (nom, description, prix, etat, vendeur_id) 
                VALUES (:n, :d, :p, :e, :v)";
        
        $statement = $connexion->prepare($sql);
        $statement->execute([
            ':n' => $nom,
            ':d' => $desc,
            ':p' => $prix,
            ':e' => $etat,
            ':v' => $vendeur // On lie l'objet à l'utilisateur
        ]);

        header('Location: profil.php'); // Retour au profil pour voir son objet
        exit();

    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}