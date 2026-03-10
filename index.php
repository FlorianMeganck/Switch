<?php include 'includes/header.php'; ?>

    <div class="bg-white p-8 rounded-lg shadow text-center">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">{{ statut }}</h2>
        
        <button @click="compteur++" class="bg-green-500 text-white px-6 py-3 rounded font-bold">
            Nombre de clics : {{ compteur }}
        </button>
    </div>

<?php include 'includes/footer.php'; ?>