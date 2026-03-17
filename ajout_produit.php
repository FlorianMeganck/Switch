<?php 
session_start();
// Sécurité : si pas connecté, pas possible d'aller plus loin
if (!isset($_SESSION['user_id'])) { header('Location: connexion.php'); exit(); }
include 'includes/header.php'; 
?>

<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-3xl shadow-xl border border-slate-100">
    <h2 class="text-2xl font-black mb-6 text-slate-800">Mettre un objet en troc</h2>
    
    <form action="traitement_produit.php" method="post" class="space-y-4">
        <input type="text" name="nom" placeholder="Nom de l'objet (ex: Équerre)" required class="w-full p-4 bg-slate-50 border rounded-2xl">
        
        <textarea name="description" placeholder="Description et état de l'objet" class="w-full p-4 bg-slate-50 border rounded-2xl h-32"></textarea>
        
        <div class="grid grid-cols-2 gap-4">
            <input type="number" name="prix" placeholder="Prix (Switchs)" required class="p-4 bg-slate-50 border rounded-2xl">
            <select name="etat" class="p-4 bg-slate-50 border rounded-2xl">
                <option value="Neuf">Neuf</option>
                <option value="Bon état">Bon état</option>
                <option value="Usagé">Usagé</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-emerald-600 text-white font-black py-4 rounded-2xl hover:bg-emerald-700 transition shadow-lg">
            Publier l'annonce
        </button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>