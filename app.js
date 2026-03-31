const { createApp } = Vue;
createApp({
    data() {
        return {
            currentPage: 'home',
            countries: [],
            message: ''
        }
    },
    mounted() {
        // Chargement des données au démarrage
    },
    methods: {
        add() {
            fetch('api/country_add.php',
                { method: 'POST', headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ vie: li.value, nb: le.value })
                })
        },
        view() {
            // aller envoyer et chercher dans le backend les données
            const li = document.querySelector('input[name=life]');
            const le = document.querySelector('input[name=length]');
            // ... .value => name du HTML
            // devant les : c'est le nom que le backend va recevoir
            fetch('api/country_life_exp.php',
                { method: 'POST', headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ vie: li.value, nb: le.value })
                })
                .then(response => response.json())
                .then(data => {
                    //if(data.success) {
                        // mettre à disposition du front-end
                        this.countries = data;
                        // changer de page
                        this.currentPage = 'my_countries';
                        this.message = '';
                    //} else {
                    //    this.message = data.message;
                    //}
                })
                .catch(error => {
                    console.error('Erreur de chargement des données:', error);
                });
            
        }
    }
}).mount('#app');