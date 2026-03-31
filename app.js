const { createApp } = Vue

createApp({
    data() {
        return {
            page: 'accueil',
            user: null,
            loginForm: { email: '', password: '' },
            registerForm: { username: '', email: '', password: '' },
            produits: [],
            message: ''
        }
    },
    methods: {
        // Vérifie si une session PHP existe au chargement de la page
        async checkSession() {
            try {
                const response = await fetch('api/check_session.php');
                const data = await response.json();
                
                if (data.connected) {
                    this.user = data.user;
                }
            } catch (err) {
                console.error("Erreur lors de la vérification de la session", err);
            }
        },

        // Charge les 4 derniers produits pour l'accueil
        async fetchProduits() {
            try {
                const response = await fetch('api/accueil.php');
                this.produits = await response.json();
            } catch (err) {
                console.error("Erreur chargement produits:", err);
            }
        },

        // Gère la connexion
        async login() {
            const formData = new FormData();
            formData.append('email', this.loginForm.email);
            formData.append('password', this.loginForm.password);

            const response = await fetch('api/connexion.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data.success) {
                this.user = data.user;
                this.page = 'accueil';
                this.message = '';
            } else {
                this.message = data.message;
            }
        },

        // Gère l'inscription
        async register() {
            const formData = new FormData();
            formData.append('username', this.registerForm.username);
            formData.append('email', this.registerForm.email);
            formData.append('password', this.registerForm.password);

            const response = await fetch('api/inscription.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data.success) {
                this.user = data.user;
                this.page = 'accueil';
                this.message = '';
            } else {
                this.message = data.message;
            }
        },

        // --- NOUVELLE MÉTHODE DE DÉCONNEXION ---
        async logout() {
            try {
                // On appelle le script PHP qui détruit la session
                await fetch('api/deconnexion.php'); 
                
                // On réinitialise l'interface
                this.user = null;
                this.page = 'accueil';
            } catch (err) {
                console.error("Erreur lors de la déconnexion", err);
            }
        }
    },
    mounted() {
        // Exécuté automatiquement à chaque rafraîchissement
        this.checkSession();   //
        this.fetchProduits();  //
    }
}).mount('#app')