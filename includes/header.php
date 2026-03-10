<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch - Troc Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <style>[v-cloak] { display: none; }</style>
</head>
<body class="bg-slate-50 text-slate-900">
    <div id="app" v-cloak>
        <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
            <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
                <a href="index.php" class="text-2xl font-black text-emerald-600 tracking-tighter">SWITCH.</a>
                <div class="flex items-center space-x-6 text-sm font-bold">
                    <a href="index.php" class="hover:text-emerald-600">Accueil</a>
                    <a href="acheter.php" class="hover:text-emerald-600">Acheter</a>
                    <a href="vendre.php" class="bg-emerald-600 text-white px-4 py-2 rounded-full hover:bg-emerald-700">Vendre</a>
                    <a href="connexion.php" class="border-l pl-6 border-slate-200 hover:text-emerald-600">Compte</a>
                </div>
            </nav>
        </header>
        <main class="max-w-6xl mx-auto px-6 py-12">