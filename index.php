<?php 
// Inclusion du header (menu + début HTML)
include 'includes/header.php';

// Connexion à la base de données
require_once __DIR__ . '/config/db_access.php';

try {
    // On récupère les 4 derniers produits non vendus
    $sql = "SELECT * FROM products WHERE is_sold = 'non' ORDER BY id DESC LIMIT 4";
    $statement = $connexion->query($sql);
    $produits = $statement->fetchAll();
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<main id="app" class="max-w-6xl mx-auto px-6 py-10 space-y-16">

    <section class="bg-slate-100 rounded-3xl p-10 flex flex-col md:flex-row justify-between items-center gap-10">

        <div class="max-w-md">
            <h1 class="text-4xl font-bold mb-4">
                Achète et vends facilement 👕
            </h1>

            <p class="text-slate-600 mb-6">
                SWITCH est une plateforme entre étudiants pour acheter, vendre ou échanger.
            </p>

            <div class="flex gap-3">
                <a href="ajout_produit.php" class="bg-black text-white px-6 py-3 rounded-xl font-bold">
                    Vendre
                </a>

                <a href="troc.php" class="bg-white border px-6 py-3 rounded-xl font-bold">
                    Voir
                </a>
            </div>
        </div>

        <img src="https://picsum.photos/600/400" class="rounded-xl shadow hidden md:block">

    </section>


    <section>
        <h2 class="text-2xl font-bold mb-6">
            🔥 Derniers objets ajoutés
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            <?php if (count($produits) > 0): ?>
                <?php foreach ($produits as $produit): ?>

                    <div class="bg-white p-4 rounded-2xl shadow">

                        <img src="https://loremflickr.com/400/300/<?php echo urlencode($produit['name']); ?>/all" class="rounded-xl mb-3 w-full">

                        <h3 class="font-bold">
                            <?php echo htmlspecialchars($produit['name']); ?>
                        </h3>

                        <p class="text-sm text-slate-500">
                            <?php echo htmlspecialchars($produit['condition']); ?>
                        </p>

                        <p class="font-bold text-emerald-600 mt-1">
                            <?php echo htmlspecialchars($produit['price']); ?> Switchs
                        </p>

                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun produit</p>
            <?php endif; ?>

        </div>

        <div class="text-center mt-8">
            <a href="troc.php" class="bg-emerald-600 text-white px-6 py-3 rounded-xl font-bold">
                Voir tous les articles
            </a>
        </div>

    </section>


    <section>
        <h2 class="text-2xl font-bold text-center mb-10">
            Comment fonctionne SWITCH ?
        </h2>

        <div class="grid md:grid-cols-3 gap-8 text-center">

            <div class="bg-white p-6 rounded-2xl shadow">
                <div class="text-3xl">📦</div>
                <h3 class="font-bold">Publie</h3>
                <p class="text-sm text-slate-600">Ajoute ton produit</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <div class="text-3xl">🔎</div>
                <h3 class="font-bold">Explore</h3>
                <p class="text-sm text-slate-600">Regarde les articles</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <div class="text-3xl">🤝</div>
                <h3 class="font-bold">Échange</h3>
                <p class="text-sm text-slate-600">Contacte les vendeurs</p>
            </div>

        </div>
    </section>

</main>

<?php 
// Footer (Vue.js + fin HTML)
include 'includes/footer.php'; 
?>