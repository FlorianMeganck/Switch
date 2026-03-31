const { createApp } = Vue

createApp({
    data() {
        return {
            // Gère l'affichage des sections (v-if="page === ...")
            page: 'accueil',
            
            // Stocke l'utilisateur quand il est connecté
            user: null,
            
            // Données du formulaire de connexion
            loginForm: {
                email: '',
                password: ''
            },
            
            // Message d'erreur éventuel
            message: '',

            // Quelques objets pour remplir ta grille au début
            produits: [
                { id: 1, name: "Pull Vintage", condition: "Très bon état", price: 15, image: null },
                { id: 2, name: "Casque Audio", condition: "Neuf", price: 40, image: null },
                { id: 3, name: "Livre de Design", condition: "Bon état", price: 5, image: null },
                { id: 4, name: "Plante Verte", condition: "En forme", price: 10, image: null }
            ]
        }
    },
    methods: {
        login() {
            // Une vérification très simple : si l'email et le pass ne sont pas vides
            if (this.loginForm.email !== "" && this.loginForm.password !== "") {
                // On crée un utilisateur fictif
                this.user = {
                    username: this.loginForm.email.split('@')[0] // Prend le nom avant l'arobase
                };
                // On redirige vers l'accueil
                this.page = 'accueil';
            } else {
                this.message = "Veuillez remplir tous les champs.";
            }
        }
    }
}).mount('#app')