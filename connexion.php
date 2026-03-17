<?php include 'includes/header.php'; ?>

<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-3xl shadow-xl border border-slate-100">
    <h2 class="text-2xl font-black mb-6 text-slate-800">Se connecter à Switch</h2>
    
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

        <?php if(isset($_GET['error'])): ?>
            <p class="text-red-500 text-xs font-bold">Email ou mot de passe incorrect.</p>
        <?php endif; ?>

        <button type="submit" class="w-full bg-emerald-600 text-white font-black py-4 rounded-2xl hover:bg-emerald-700 transition shadow-lg mt-4">
            Connexion
        </button>
    </form>
    
    <p class="mt-6 text-center text-sm text-slate-500">
        Pas encore de compte ? <a href="inscription.php" class="text-emerald-600 font-bold">S'inscrire</a>
    </p>
</div>

<?php include 'includes/footer.php'; ?>