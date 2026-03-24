<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Switch - Marketplace étudiante</title>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Vue JS pour l'interaction -->
<script src="https://unpkg.com/vue@3"></script>

</head>


<body class="bg-slate-50 font-sans">





<main id="app" class="max-w-6xl mx-auto px-6 py-10 space-y-16">


<!-- HERO -->
<section class="bg-slate-100 rounded-3xl p-10 flex flex-col md:flex-row justify-between items-center gap-10">

<div class="max-w-md">

<h2 class="text-4xl font-bold mb-4">
Achète et vends facilement 👕
</h2>

<p class="text-slate-600 mb-6">
SWITCH est une plateforme de vente et de troc entre étudiants.
Découvre des milliers d'articles à petit prix.
</p>

<button class="bg-black text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-800">
Commencer à vendre
</button>

</div>

<div class="hidden md:block">
<img src="https://via.placeholder.com/300x250" class="rounded-xl shadow">
</div>

</section>



<!-- ARTICLES POPULAIRES -->
<section>

<h3 class="text-2xl font-bold mb-6">
🔥 Articles populaires
</h3>


<div class="grid grid-cols-2 md:grid-cols-4 gap-6">


<div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">

<img src="https://via.placeholder.com/200" class="rounded-xl mb-3 w-full">

<h4 class="font-bold">Pull Nike</h4>
<p class="text-sm text-slate-500">Taille M</p>
<p class="font-bold mt-1">25€</p>

</div>


<div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">

<img src="https://via.placeholder.com/200" class="rounded-xl mb-3 w-full">

<h4 class="font-bold">Jean Zara</h4>
<p class="text-sm text-slate-500">Taille L</p>
<p class="font-bold mt-1">18€</p>

</div>


<div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">

<img src="https://via.placeholder.com/200" class="rounded-xl mb-3 w-full">

<h4 class="font-bold">Sneakers Adidas</h4>
<p class="text-sm text-slate-500">Pointure 42</p>
<p class="font-bold mt-1">40€</p>

</div>


<div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">

<img src="https://via.placeholder.com/200" class="rounded-xl mb-3 w-full">

<h4 class="font-bold">Veste vintage</h4>
<p class="text-sm text-slate-500">Taille S</p>
<p class="font-bold mt-1">35€</p>

</div>


</div>


<div class="text-center mt-8">

<button class="bg-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-emerald-700">
Voir tous les articles
</button>

</div>

</section>



<!-- COMMENT CA MARCHE -->
<section>

<h3 class="text-2xl font-bold text-center mb-10">
Comment fonctionne SWITCH ?
</h3>


<div class="grid md:grid-cols-3 gap-8 text-center">


<div>

<div class="text-4xl mb-3">📦</div>

<h4 class="font-bold mb-2">Publie ton objet</h4>

<p class="text-slate-600">
Ajoute facilement un produit avec un nom, une description et un prix.
</p>

</div>



<div>

<div class="text-4xl mb-3">🔎</div>

<h4 class="font-bold mb-2">Explore les articles</h4>

<p class="text-slate-600">
Découvre les objets proposés par les autres étudiants.
</p>

</div>



<div>

<div class="text-4xl mb-3">🤝</div>

<h4 class="font-bold mb-2">Achète ou échange</h4>

<p class="text-slate-600">
Contacte les vendeurs et réalise ton échange facilement.
</p>

</div>


</div>

</section>



<!-- SECTION JS DEMO -->
<section class="text-center">

<p class="text-slate-600 mb-3">
{{ message }}
</p>


<button
@click="compteur++"
class="bg-emerald-600 text-white px-6 py-2 rounded-xl hover:bg-emerald-700"
>

Cliques : {{ compteur }}

</button>

</section>


</main>