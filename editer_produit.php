<?php 
session_start();
require_once __DIR__ . '/config/db_access.php';

// 1. Récupérer le produit à modifier
$id_produit = $_GET['id'];
$stmt = $connexion->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id_produit]);
$p = $stmt->fetch();

// 2. Récupérer les catégories pour le menu déroulant
$categories = $connexion->query("SELECT * FROM categorys ORDER BY name ASC")->fetchAll();

include 'includes/header.php'; 
?>

<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-3xl shadow-xl border border-slate-100">
    <h2 class="text-2xl font-black mb-6 text-slate-800">Modifier mon annonce</h2>
    
    <form action="traitement_edition.php" method="post" class="space-y-4">
        <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">

        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Nom de l'objet</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($p['name']); ?>" required class="w-full p-4 bg-slate-50 border rounded-2xl">
        </div>

        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 mb-1 ml-1">Catégorie</label>
            <select name="category_id" class="w-full p-4 bg-slate-50 border rounded-2xl">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $p['category_id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="w-full bg-slate-800 text-white font-black py-4 rounded-2xl hover:bg-black transition shadow-lg mt-4">
            Sauvegarder les changements
        </button>
    </form>
</div>