<?php include 'includes/header.php'; ?>

<main id="app" class="max-w-6xl mx-auto px-6 py-10 space-y-16">

    <!-- HERO -->
    <section class="bg-slate-100 rounded-3xl p-10 flex flex-col md:flex-row justify-between items-center gap-10">

        <div class="max-w-md">
            <h1 class="text-4xl font-bold mb-4">
                Achète et vends facilement 👕
            </h1>

            <p class="text-slate-600 mb-6">
                SWITCH est une plateforme de vente et de troc entre étudiants.
                Découvre des articles à petit prix et publie facilement les tiens.
            </p>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="inscription.php"
                   class="bg-black text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-800 transition text-center">
                    Commencer à vendre
                </a>

                <a href="troc.php"
                   class="bg-white text-slate-900 px-6 py-3 rounded-xl font-bold border border-slate-300 hover:bg-slate-50 transition text-center">
                    Voir les articles
                </a>
            </div>
        </div>

        <div class="hidden md:block">
            <img 
                src="https://via.placeholder.com/300x250"
                alt="Illustration de la marketplace SWITCH"
                class="rounded-xl shadow"
            >
        </div>
    </section>


    <!-- ARTICLES POPULAIRES -->
    <section>
        <h2 class="text-2xl font-bold mb-6">
            🔥 Articles populaires
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            <article class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
                <img src="https://via.placeholder.com/200" alt="Pull Nike" class="rounded-xl mb-3 w-full">
                <h3 class="font-bold">Pull Nike</h3>
                <p class="text-sm text-slate-500">Taille M</p>
                <p class="font-bold mt-1">25€</p>
            </article>

            <article class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
                <img src="https://via.placeholder.com/200" alt="Jean Zara" class="rounded-xl mb-3 w-full">
                <h3 class="font-bold">Jean Zara</h3>
                <p class="text-sm text-slate-500">Taille L</p>
                <p class="font-bold mt-1">18€</p>
            </article>

            <article class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
                <img src="https://via.placeholder.com/200" alt="Sneakers Adidas" class="rounded-xl mb-3 w-full">
                <h3 class="font-bold">Sneakers Adidas</h3>
                <p class="text-sm text-slate-500">Pointure 42</p>
                <p class="font-bold mt-1">40€</p>
            </article>

            <article class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
                <img src="https://via.placeholder.com/200" alt="Veste vintage" class="rounded-xl mb-3 w-full">
                <h3 class="font-bold">Veste vintage</h3>
                <p class="text-sm text-slate-500">Taille S</p>
                <p class="font-bold mt-1">35€</p>
            </article>

        </div>

        <div class="text-center mt-8">
            <a href="troc.php"
               class="bg-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-emerald-700 transition inline-block">
                Voir tous les articles
            </a>
        </div>
    </section>


    <!-- COMMENT CA MARCHE -->
    <section>
        <h2 class="text-2xl font-bold text-center mb-10">
            Comment fonctionne SWITCH ?
        </h2>

        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div class="bg-white rounded-2xl p-6 shadow">
                <div class="text-4xl mb-3">📦</div>
                <h3 class="font-bold mb-2">Publie ton objet</h3>
                <p class="text-slate-600">
                    Ajoute un produit avec un nom, une description, un prix et son état.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <div class="text-4xl mb-3">🔎</div>
                <h3 class="font-bold mb-2">Explore les articles</h3>
                <p class="text-slate-600">
                    Parcours les objets proposés par les autres étudiants.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <div class="text-4xl mb-3">🤝</div>
                <h3 class="font-bold mb-2">Achète ou échange</h3>
                <p class="text-slate-600">
                    Contacte les vendeurs et réalise ton échange facilement.
                </p>
            </div>
        </div>
    </section>


    <!-- MINI INTERACTION JS -->
    <section class="text-center bg-white rounded-2xl p-6 shadow">
        <p class="text-slate-600 mb-3">
            {{ message }}
        </p>

        <button
            @click="compteur++"
            class="bg-emerald-600 text-white px-6 py-2 rounded-xl hover:bg-emerald-700 transition"
        >
            Cliques : {{ compteur }}
        </button>
    </section>

</main>

<!-- Vue JS pour l'interaction du bas -->
<script src="https://unpkg.com/vue@3"></script>
<script>
const app = Vue.createApp({
    data() {
        return {
            message: "Petite interaction JavaScript pour montrer le dynamisme du site",
            compteur: 0
        };
    }
});
app.mount('#app');
</script>

<?php include 'includes/footer.php'; ?>