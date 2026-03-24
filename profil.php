<?php 
session_start(); 
include 'includes/header.php'; 
?>

<div class="max-w-2xl mx-auto mt-10 px-6">
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
            <div class="bg-emerald-600 h-32"></div>
            <div class="px-8 pb-8">
                <div class="relative">
                    <div class="absolute -top-12 left-0 w-24 h-24 bg-slate-200 rounded-2xl border-4 border-white flex items-center justify-center text-3xl font-black text-slate-400">
                        <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                    </div>
                </div>
                
                <div class="mt-16 flex justify-between items-end">
                    <div>
                        <h2 class="text-3xl font-black text-slate-800"><?php echo htmlspecialchars($_SESSION['username']); ?></h2>
                        <p class="text-slate-500">Membre de la communauté Switch</p>
                    </div>
                    <a href="deconnexion.php" class="text-sm font-bold text-red-500 hover:underline mb-1">Se déconnecter</a>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 mb-1">Mon Solde</span>
                        <span class="text-2xl font-black text-emerald-600">0.00 SW</span>
                    </div>
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 mb-1">Objets en ligne</span>
                        <span class="text-2xl font-black text-slate-800">1</span>
                    </div>
                </div>

                <div class="mt-10">
                    <h3 class="text-xl font-bold text-slate-800 mb-4">Mes annonces</h3>
                    <div class="flex items-center justify-between bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-200 rounded-lg flex items-center justify-center">📦</div>
                            <p class="font-bold text-slate-800">Dernier objet ajouté</p>
                        </div>
                        <a href="editer_produit.php" class="text-sm font-bold text-emerald-600 hover:underline">Modifier</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>