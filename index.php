<?php include 'includes/header.php'; ?>

<div class="max-w-3xl mx-auto text-center">
    <h1 class="text-6xl font-black leading-none mb-6">Échangez. <br><span class="text-emerald-600">Ne jetez plus.</span></h1>
    <p class="text-lg text-slate-500 mb-10">La première plateforme de troc pensée par et pour les étudiants de la HEPL.</p>
    
    <div class="grid grid-cols-2 gap-6">
        <a href="acheter.php" class="p-8 bg-white border border-slate-200 rounded-3xl hover:border-emerald-500 transition-all shadow-sm group">
            <div class="text-3xl mb-4 group-hover:scale-110 transition-transform">🔍</div>
            <h2 class="font-bold text-xl">Je cherche un objet</h2>
        </a>
        <a href="vendre.php" class="p-8 bg-emerald-600 text-white rounded-3xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 group">
            <div class="text-3xl mb-4 group-hover:scale-110 transition-transform">📦</div>
            <h2 class="font-bold text-xl">Je propose un troc</h2>
        </a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>