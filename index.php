<?php include 'includes/header.php'; ?>
<pre><?php session_start(); print_r($_SESSION); ?></pre>

<div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-100 text-center">
    <h2 class="text-3xl font-black mb-4">{{ message }}</h2>
    
    <p class="text-slate-500 mb-8">Test de réactivité :</p>
    
    <button @click="compteur++" class="bg-emerald-600 text-white px-8 py-4 rounded-2xl font-black hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
        Nombre de clics : {{ compteur }}
    </button>
</div>

<?php include 'includes/footer.php'; ?>