<?php 
session_start(); // On démarre la session pour vérifier l'état de connexion
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
                
                <div class="mt-16">
                    <h2 class="text-3xl font-black text-slate-800"><?php echo $_SESSION['username']; ?></h2>
                    <p class="text-slate-500">Membre de la communauté Switch</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 mb-1">Mon Solde</span>
                        <span class="text-2xl font-black text-emerald-600">0 Switchs</span>
                    </div>
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 mb-1">Trocs effectués</span>
                        <span class="text-2xl font-black text-slate-800">0</span>
                    </div>
                </div>

                <a href="deconnexion.php" class="block mt-8 text-center text-sm font-bold text-red-500 hover:underline">
                    Se déconnecter
                </a>
            </div>
        </div>

    <?php else: ?>
        <div class="bg-white p-8 rounded-3xl shadow-xl border border-slate-100 max-w-md mx-auto">
            <h2 class="text-2xl font-black mb-6 text-slate-800">Connexion</h2>
            
            <form action="traitement_connexion.php" method="post" class="space-y-4">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Email</label>
                    <input type="email" name="email" required placeholder="nom@student.hepl.be" 
                           class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Mot de passe</label>
                    <input type="password" name="password" required placeholder="••••••••" 
                           class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
                </div>

                <button type="submit" class="w-full bg-emerald-600 text-white font-black py-4 rounded-2xl hover:bg-emerald-700 transition shadow-lg mt-4">
                    Se connecter
                </button>
            </form>
            
            <p class="mt-6 text-center text-sm text-slate-500">
                Pas encore de compte ? <a href="inscription.php" class="text-emerald-600 font-bold">S'inscrire</a>
            </p>
        </div>
    <?php endif; ?>

</div>

<?php include 'includes/footer.php'; ?>