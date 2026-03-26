<?php
// 1. Démarrage sécurisé de la session
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

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Vue JS -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <!-- STYLE POUR ANIMATION NAV -->
    <style>
        /* Lien de navigation */
        .nav-link {
            position: relative;
            font-weight: bold;
            transition: transform 0.2s ease;
        }

        /* Effet agrandissement */
        .nav-link:hover {
            transform: scale(1.1);
        }

        /* Ligne cachée */
        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 0%;
            height: 2px;
            background-color: #059669; /* vert SWITCH */
            transition: width 0.3s ease;
        }

        /* Animation gauche → droite */
        .nav-link:hover::after {
            width: 100%;
        }
    </style>

</head>

<body class="bg-slate-50 text-slate-900">

<div id="app">

<header class="bg-white border-b border-slate-200 py-4 mb-10">
    <div class="max-w-4xl mx-auto flex justify-between items-center">

        <!-- LOGO -->
        <a href="index.php">
            <h1 class="text-2xl font-black text-emerald-600">
                SWITCH.
            </h1>
        </a>

        <!-- NAVIGATION -->
        <nav class="flex gap-6 text-sm uppercase">

            <a href="index.php" class="nav-link">Accueil</a>
            <a href="troc.php" class="nav-link">Troc</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="ajout_produit.php" class="nav-link">Ajout produit</a>
                <a href="profil.php" class="nav-link">Mon compte</a>
            <?php else: ?>
                <a href="connexion.php" class="nav-link">Connexion</a>
            <?php endif; ?>

        </nav>

    </div>
</header>

<main class="max-w-4xl mx-auto px-6">