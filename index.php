<?php 
// Le header inclut déjà session_start() !
include 'includes/header.php'; 
// On appelle la base de données pour pouvoir lire les articles
require_once __DIR__ . '/config/db_access.php';

try {
    // Trouve la ligne de ta requête SQL au début du fichier
    $sql = "SELECT * FROM products WHERE is_sold = 'non' ORDER BY id DESC LIMIT 4";
    $statement = $connexion->query($sql);
    $produits = $statement->fetchAll();
} catch (PDOException $e) {
    die("Erreur de récupération des produits : " . $e->getMessage());
}
?>

<main id="app" class="max-w-6xl mx-auto px-6 py-10 space-y-16">

    <section class="bg-slate-100 rounded-3xl p-10 flex flex-col md:flex-row justify-between items-center gap-10">
        <div class="max-w-md">
            <h1 class="text-4xl font-bold mb-4">Achète et vends facilement 👕</h1>
            <p class="text-slate-600 mb-6">
                SWITCH est une plateforme de vente et de troc entre étudiants.
                Découvre des articles à petit prix et publie facilement les tiens.
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="ajout_produit.php" class="bg-black text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-800 transition text-center">Commencer à vendre</a>
                <a href="troc.php" class="bg-white text-slate-900 px-6 py-3 rounded-xl font-bold border border-slate-300 hover:bg-slate-50 transition text-center">Voir les articles</a>
            </div>
        </div>
        <div class="hidden md:block">
            <img src="https://via.placeholder.com/300x250" alt="Illustration SWITCH" class="rounded-xl shadow">
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-bold mb-6">🔥 Derniers objets ajoutés</h2>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    <?php if (count($produits) > 0): ?>
        <?php foreach ($produits as $produit): ?>
            
            <article class="bg-white p-4 rounded-2xl shadow border border-slate-100 relative group">
                
                <a href="editer_produit.php?id=<?php echo $produit['id']; ?>" 
                   class="absolute top-3 right-3 bg-white/90 w-8 h-8 rounded-full shadow-md flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-emerald-50 text-xs"
                   title="Modifier cet article">
                   ✏️
                </a>

                <img src="https://via.placeholder.com/200?text=Switch" class="rounded-xl mb-3 w-full object-cover h-40">
                
                <h3 class="font-bold truncate text-slate-800"><?php echo htmlspecialchars($produit['name']); ?></h3>
                <p class="text-sm text-slate-500"><?php echo htmlspecialchars($produit['condition']); ?></p>
                <p class="font-bold mt-2 text-emerald-600"><?php echo htmlspecialchars($produit['price']); ?> Switchs</p>
            </article>

        <?php endforeach; ?>
    <?php else: ?>
        <p class="col-span-4 text-center text-slate-500 py-10">Aucun objet disponible.</p>
    <?php endif; ?>
</div>

        <div class="text-center mt-8">
            <a href="troc.php" class="bg-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-emerald-700 transition shadow-lg">
                Voir tous les articles
            </a>
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-bold text-center mb-10">Comment fonctionne SWITCH ?</h2>
        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div class="bg-white rounded-2xl p-6 shadow border border-slate-100">
                <div class="text-4xl mb-3">📦</div>
                <h3 class="font-bold mb-2">Publie ton objet</h3>
                <p class="text-slate-600 text-sm">Ajoute facilement un produit.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow border border-slate-100">
                <div class="text-4xl mb-3">🔎</div>
                <h3 class="font-bold mb-2">Explore les articles</h3>
                <p class="text-slate-600 text-sm">Découvre les objets.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow border border-slate-100">
                <div class="text-4xl mb-3">🤝</div>
                <h3 class="font-bold mb-2">Achète ou échange</h3>
                <p class="text-slate-600 text-sm">Contacte les vendeurs.</p>
            </div>
        </div>
    </section>

</main>

<?php 
// N'oublie pas que ton Vue.js est géré dans le footer !
include 'includes/footer.php'; 
?>