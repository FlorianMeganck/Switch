<?php include 'includes/header.php'; ?>

<!-- BANNIÈRE -->
<section class="bg-gray-100 p-10 rounded-3xl text-center mb-10">
    <h1 class="text-4xl font-bold mb-4">Achète et vends facilement 👕</h1>
    <p class="text-gray-600 mb-6">Des milliers d’articles à petits prix</p>
    <a href="ajout_produit.php" class="bg-black text-white px-6 py-3 rounded-xl">
        Commencer à vendre
    </a>
</section>

<!-- SECTION PRODUITS -->
<section>
    <h2 class="text-2xl font-bold mb-6">🔥 Articles populaires</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <!-- PRODUIT 1 -->
        <div class="bg-white rounded-2xl shadow-sm p-4 hover:shadow-md transition">
           <img src="https://img01.ztat.net/article/spp-media-p1/30e4ae569d4208a0862f6f22281bc394/2230ec5fe2b44695bd1425517c8ad17e.jpg?imwidth=1800"
     class="rounded-xl mb-3 w-full h-48 object-cover">
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
            <p class="font-bold mt-2">35€</p>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>