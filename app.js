const { createApp } = Vue;

createApp({
    data() {
        return {
            page: 'accueil', // Doit matcher avec v-if="page === 'accueil'" dans l'HTML
            produits: [],    // Contiendra les produits reçus du PHP
            message: ''
        }
    },
    // Se lance automatiquement à l'ouverture de la page
    mounted() {
        this.chargerAccueil();
    },
    methods: {
        chargerAccueil() {
            // On appelle ton nouveau fichier api/accueil.php
            fetch('api/accueil.php')
                .then(response => response.json())
                .then(data => {
                    // On met les données dans la variable produits
                    this.produits = data;
                })
                .catch(error => {
                    console.error("Erreur de chargement :", error);
                });
        }
    }
}).mount('#app');