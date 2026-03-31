<?php 
// 1. Démarrage de la session et vérification de l'authentification
session_start();
if (!isset($_SESSION['user_id'])) { 
    header('Location: connexion.php'); 
    exit(); 
}

// 2. Connexion à la base de données pour récupérer les catégories
require_once __DIR__ . '/config/db_access.php';

try {
    $queryCat = $connexion->query("SELECT * FROM categorys ORDER BY name ASC");
    $categories = $queryCat->fetchAll();
} catch (PDOException $e) {
    $categories = []; 
}

include 'includes/header.php'; 
?>

<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-3xl shadow-xl border border-slate-100">
    <h2 class="text-2xl font-black mb-6 text-slate-800">Publier une annonce</h2>
    
    <form action="traitement_produit.php" method="post" enctype="multipart/form-data" class="space-y-4">
        
        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Nom de l'objet</label>
            <input type="text" name="name" placeholder="Ex: Équerre, Syllabus..." required 
                   class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
        </div>

        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-4">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Choisir une catégorie existante</label>
                <select name="category_id" class="w-full p-4 bg-white border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>">
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <span class="h-[1px] bg-slate-200 grow"></span>
                <span class="text-[10px] font-black uppercase text-slate-300">Ou en créer une</span>
                <span class="h-[1px] bg-slate-200 grow"></span>
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Nouvelle catégorie</label>
                <input type="text" name="new_category_name" placeholder="Ex: Sport, Kot, Jeux..." 
                       class="w-full p-4 bg-white border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Photo de l'objet</label>
            <input type="file" name="product_image" accept=".jpg,.jpeg,.png,.webp" class="...">
                   class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
        </div>
        
        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Description</label>
            <textarea name="description" placeholder="Détails sur l'objet et son état..." 
                      class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl h-32 outline-none focus:ring-2 focus:ring-emerald-500 transition"></textarea>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Prix (Switchs)</label>
                <input type="number" step="0.01" name="price" placeholder="0.00" required 
                       class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">État</label>
                <select name="condition" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    <option value="New">Neuf</option>
                    <option value="Good">Bon état</option>
                    <option value="Used">Usagé</option>
                </select>
            </div>
        </div>

        <button type="submit" class="w-full bg-emerald-600 text-white font-black py-4 rounded-2xl hover:bg-emerald-700 transition shadow-lg mt-4">
            Mettre en ligne
        </button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>