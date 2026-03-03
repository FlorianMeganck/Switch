<script setup>
import { ref } from 'vue'

// 1. On crée une liste de produits "pour de faux" en attendant de brancher ta DB
const produits = ref([
  { id: 1, nom: 'iPhone 13', prix: 450, desc: 'Très bon état', cat: 'Électronique' },
  { id: 2, nom: 'Veste en cuir', prix: 60, desc: 'Style vintage, Taille L', cat: 'Vêtements' },
  { id: 3, nom: 'Console PS5', prix: 380, desc: 'Vendue avec 2 manettes', cat: 'Jeux Vidéo' }
])
</script>

<template>
  <div class="app-container">
    <header>
      <h1>SWITCH</h1>
      <p>Ta plateforme d'échange</p>
    </header>

    <main>
      <section class="welcome">
        <h2>Bienvenue, Florian !</h2>
        <div class="stats">Solde : <strong>0.00 €</strong></div>
      </section>

      <section class="catalogue">
        <h3>Articles récents</h3>
        <div class="grid">
          <div v-for="item in produits" :key="item.id" class="card">
            <span class="category">{{ item.cat }}</span>
            <h4>{{ item.nom }}</h4>
            <p>{{ item.desc }}</p>
            <p class="price">{{ item.prix }} €</p>
            <button class="btn-buy">Voir l'article</button>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<style scoped>
/* 3. Le look de ton app SWITCH */
.app-container { font-family: sans-serif; max-width: 900px; margin: 0 auto; color: #2c3e50; }
header { background-color: #42b883; color: white; padding: 2rem; text-align: center; border-radius: 0 0 20px 20px; }
h1 { margin: 0; font-size: 2.5rem; letter-spacing: 3px; }

.catalogue { padding: 20px; }
.grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-top: 20px; }

.card { 
  border: 1px solid #eee; 
  padding: 15px; 
  border-radius: 12px; 
  box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
  text-align: left;
}

.category { font-size: 0.7rem; color: #42b883; font-weight: bold; text-transform: uppercase; }
.price { font-size: 1.2rem; font-weight: bold; margin: 10px 0; }
.btn-buy { background: #42b883; color: white; border: none; padding: 10px; border-radius: 8px; width: 100%; cursor: pointer; }
</style>