<?php include 'includes/header.php'; ?>
<pre><?php session_start(); print_r($_SESSION); ?></pre>

<!-- HERO / BANNIÈRE -->
<section class="bg-gray-100 p-10 rounded-3xl text-center mb-10">
    <h1 class="text-4xl font-bold mb-4">Achète et vends facilement 👕</h1>
    <p class="text-gray-600 mb-6">Des milliers d’articles à petits prix</p>
    <a href="ajout_produit.php" class="bg-black text-white px-6 py-3 rounded-xl">
        Commencer à vendre
    </a>
</section>

<!-- TON BOUTON (INTOUCHABLE) -->
<div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-100 text-center mb-10">
    <h2 class="text-3xl font-black mb-4">{{ message }}</h2>
    <p class="text-slate-500 mb-8">Test de réactivité</p>

    <button @click="compteur++"
        class="bg-emerald-600 text-white px-8 py-4 rounded-2xl font-black hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
        Nombre de clics : {{ compteur }}
    </button>
</div>

<!-- SECTION PRODUITS -->
<section>
    <h2 class="text-2xl font-bold mb-6">🔥 Articles populaires</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

        <!-- PRODUIT 1 -->
        <div class="bg-white rounded-2xl shadow-sm p-4 hover:shadow-md transition">
            <img src="https://via.placeholder.com/300" class="rounded-xl mb-3">
            <h3 class="font-semibold">Pull Nike</h3>
            <p class="text-gray-500 text-sm">Taille M</p>
            <p class="font-bold mt-2">25€</p>
        </div>

        <!-- PRODUIT 2 -->
        <div class="bg-white rounded-2xl shadow-sm p-4 hover:shadow-md transition">
            <img src="https://via.placeholder.com/300" class="rounded-xl mb-3">
            <h3 class="font-semibold">Jean Zara</h3>
            <p class="text-gray-500 text-sm">Taille L</p>
            <p class="font-bold mt-2">18€</p>
        </div>

        <!-- PRODUIT 3 -->
        <div class="bg-white rounded-2xl shadow-sm p-4 hover:shadow-md transition">
            <img src="https://via.placeholder.com/300" class="rounded-xl mb-3">
            <h3 class="font-semibold">Sneakers Adidas</h3>
            <p class="text-gray-500 text-sm">42</p>
            <p class="font-bold mt-2">40€</p>
        </div>

        <!-- PRODUIT 4 -->
        <div class="bg-white rounded-2xl shadow-sm p-4 hover:shadow-md transition">
            <img src="https://via.placeholder.com/300" class="rounded-xl mb-3">
            <h3 class="font-semibold">Veste vintage</h3>
            <p class="text-gray-500 text-sm">Taille S</p>
            <p class="font-bold mt-2">30€</p>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>