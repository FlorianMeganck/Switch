<?php include 'includes/header.php'; ?>

    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <h2 class="text-3xl font-bold mb-4">{{ titreSite }}</h2>
        
        <p class="text-gray-600 mb-6 text-lg">Prêt pour le troc étudiant ?</p>

        <button @click="compteur++" class="bg-emerald-500 text-white px-6 py-2 rounded-lg font-bold">
            Nombre de clics : {{ compteur }}
        </button>
    </div>

<?php include 'includes/footer.php'; ?>