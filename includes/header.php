<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Switch - Marketplace étudiante</title>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-900">
<div class="min-h-screen flex flex-col">

<header class="bg-white border-b border-slate-200">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- LOGO -->
        <a href="index.php" class="text-2xl font-extrabold text-emerald-600">
            SWITCH.
        </a>

        <!-- NAV -->
        <nav class="flex items-center gap-6 md:gap-8 font-extrabold text-base md:text-lg">

            <!-- LIEN 1 -->
            <a href="index.php" class="relative group">
                ACCUEIL
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-black transition-all duration-300 group-hover:w-full"></span>
            </a>

            <!-- LIEN 2 -->
            <a href="troc.php" class="relative group">
                TROC
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-black transition-all duration-300 group-hover:w-full"></span>
            </a>

            <!-- LIEN 3 -->
            <a href="profil.php" class="relative group">
                COMPTE
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-black transition-all duration-300 group-hover:w-full"></span>
            </a>

            <!-- LIEN 4 -->
            <a href="ajout_produit.php" class="relative group">
                AJOUT PRODUIT
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-black transition-all duration-300 group-hover:w-full"></span>
            </a>

        </nav>

    </div>
</header>