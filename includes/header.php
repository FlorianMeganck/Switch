<?php 
// 1. Démarrage sécurisé de la session (doit toujours être la première ligne du fichier !)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch - Le troc facile</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>
<body class="bg-slate-50 text-slate-900">

    <div id="app">
        
        <header class="bg-white border-b border-slate-200 p-4 mb-10">
            <div class="max-w-4xl mx-auto flex justify-between items-center">
                <a href="index.php"><h1 class="text-2xl font-black text-emerald-600">SWITCH.</h1></a>
                
                <nav class="space-x-6 font-bold text-sm uppercase">
                    <a href="index.php" class="hover:text-emerald-600">Accueil</a>
                    <a href="troc.php" class="hover:text-emerald-600">Troc</a>
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="ajout_produit.php" class="text-emerald-600 border border-emerald-600 px-3 py-1 rounded hover:bg-emerald-50 transition">Ajout produit</a>
                        <a href="profil.php" class="hover:text-emerald-600">Mon Compte</a>
                    <?php else: ?>
                        <a href="connexion.php" class="hover:text-emerald-600">Connexion</a>
                    <?php endif; ?>
                </nav>
            </div>
        </header>

        <main class="max-w-4xl mx-auto px-6">