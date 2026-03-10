<?php include 'includes/header.php'; ?>

<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-3xl shadow-xl border border-slate-100">
    <h2 class="text-2xl font-black mb-6 text-slate-800">Créer un compte Switch</h2>
    
    <form action="traitement_inscription.php" method="post" class="space-y-4">
        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Nom d'utilisateur</label>
            <input type="text" name="username" required placeholder="Ex: JeanD" 
                   class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
        </div>
        
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
            S'inscrire
        </button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>