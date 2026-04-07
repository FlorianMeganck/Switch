const { createApp } = Vue

createApp({
    data() {
        return {
            page: 'accueil',
            user: null,
            message: '',
            produits: [],
            categories: [], // Liste des catégories pour le formulaire
            
            // Formulaires
            loginForm: { email: '', password: '' },
            registerForm: { username: '', email: '', password: '' },
            
            // Formulaire de vente (calqué sur ton ancien PHP)
            selectedFile: null,
            vendreForm: {
                name: '',
                category_id: '',
                new_category_name: '',
                description: '',
                price: '',
                condition: 'Good' // Valeur par défaut
            },

            // --- AJOUT DATA ÉDITION ---
            editForm: {
                id: null,
                name: '',
                category_id: '',
                new_category_name: '',
                description: '',
                price: '',
                condition: '',
                current_image: null // Pour afficher l'image actuelle
            }
        }
    },
    methods: {
        // --- SESSIONS & AUTHENTIFICATION ---
        async checkSession() {
            try {
                // Actuellement, on vérifie juste la session PHP.
                // TODO : Intégrer ici la vérification du COOKIE "Remember Me" 
                // généré par le backend si l'utilisateur avait coché la case.
                const response = await fetch('api/check_session.php');
                const data = await response.json();
                if (data.connected) {
                    this.user = data.user;
                }
            } catch (err) {
                console.error("Erreur session:", err);
            }
        },

        async login() {
            /* CHANGEMENT À VENIR : Simplification du processus de connexion.
            Au lieu d'utiliser FormData, je vais passer à l'envoi 
            en JSON comme dans l'exemple du cours.
            Cela va permettre d'utiliser REST et facilite la lecture du body en PHP */
            const formData = new FormData();
            formData.append('email', this.loginForm.email);
            formData.append('password', this.loginForm.password);
            // TODO : Ajouter loginForm.remember pour la gestion du cookie persistant de 30 jours.

            const response = await fetch('api/connexion.php', { method: 'POST', body: formData });
            const data = await response.json();

            if (data.success) {
                this.user = data.user;
                this.page = 'accueil';
                this.message = '';
            } else {
                this.message = data.message;
            }
        },

        async register() {
            // Même logique de simplification prévue : passage au format JSON
            // TODO : l'API avec les standards REST.
            const formData = new FormData();
            formData.append('username', this.registerForm.username);
            formData.append('email', this.registerForm.email);
            formData.append('password', this.registerForm.password);

            const response = await fetch('api/inscription.php', { method: 'POST', body: formData });
            const data = await response.json();

            if (data.success) {
                this.user = data.user;
                this.page = 'accueil';
                this.message = '';
            } else {
                this.message = data.message;
            }
        },

        async logout() {
            // NOTE : À la déconnexion, il faudra aussi penser à supprimer 
            // le cookie "Remember Me" côté PHP.
            await fetch('api/deconnexion.php');
            this.user = null;
            this.page = 'accueil';
        },
        // --- GESTION DES PRODUITS & CATÉGORIES ---
        async fetchProduits() {
            try {
                const response = await fetch('api/accueil.php');
                this.produits = await response.json();
            } catch (err) {
                console.error("Erreur produits:", err);
            }
        },

        async fetchCategories() {
            try {
                const response = await fetch('api/get_categories.php');
                this.categories = await response.json();
            } catch (err) {
                console.error("Erreur catégories:", err);
            }
        },

        handleFileUpload(event) {
            // Capture le fichier image sélectionné
            this.selectedFile = event.target.files[0];
        },

        async vendreProduit() {
            const formData = new FormData();
            // On ajoute tous les champs du formulaire de vente
            for (let key in this.vendreForm) {
                formData.append(key, this.vendreForm[key]);
            }
            // On ajoute l'image si elle existe
            if (this.selectedFile) {
                formData.append('product_image', this.selectedFile);
            }

            try {
                const response = await fetch('api/produit.php', { method: 'POST', body: formData });
                const data = await response.json();

                if (data.success) {
                    alert("Annonce publiée !");
                    this.page = 'accueil';
                    this.fetchProduits(); // Rafraîchit la liste d'accueil
                    // Réinitialisation du formulaire
                    this.vendreForm = { name: '', category_id: '', new_category_name: '', description: '', price: '', condition: 'Good' };
                } else {
                    alert(data.message);
                }
            } catch (err) {
                alert("Erreur lors de l'envoi.");
            }
        },

        // --- AJOUT MÉTHODES ÉDITION ---
        prepareEdit(produit) {
            // On pré-remplit le formulaire avec les données du produit sélectionné
            this.editForm = { ...produit }; 
            this.editForm.current_image = produit.image;
            this.page = 'editer'; // Bascule sur la page d'édition
        },

        async modifierProduit() {
            const formData = new FormData();
            // On ajoute l'ID et les champs texte requis par edition.php
            formData.append('product_id', this.editForm.id);
            formData.append('name', this.editForm.name);
            formData.append('category_id', this.editForm.category_id);
            formData.append('new_category_name', this.editForm.new_category_name);
            formData.append('description', this.editForm.description);
            formData.append('price', this.editForm.price);
            formData.append('condition', this.editForm.condition);

            // Si une nouvelle photo est choisie
            if (this.selectedFile) {
                formData.append('product_image', this.selectedFile);
            }

            try {
                const response = await fetch('api/edition.php', { method: 'POST', body: formData });
                const data = await response.json();

                if (data.success) {
                    alert("Modification réussie !");
                    this.page = 'profil'; // Retour au profil
                    this.fetchProduits(); // Actualise les données
                } else {
                    alert(data.message);
                }
            } catch (err) {
                alert("Erreur lors de la modification.");
            }
        },

        getMyLastProduct() {
            // Cherche dans la liste globale le premier produit qui t'appartient
            return this.produits.find(p => p.seller_id == this.user.id);
        },

        getMyProductsCount() {
            // On filtre la liste pour ne garder que tes produits et on compte la longueur
            return this.produits.filter(p => p.seller_id == this.user.id).length;
        },

        async supprimerProduit(id) {
            // Une petite sécurité pour éviter les clics accidentels
            if (!confirm("Es-tu sûr de vouloir supprimer cet article ?")) return;

            const formData = new FormData();
            formData.append('product_id', id);

            try {
                const response = await fetch('api/suppression.php', { method: 'POST', body: formData });
                const data = await response.json();

                if (data.success) {
                    // On rafraîchit la liste pour que le compteur et l'annonce disparaissent
                    this.fetchProduits(); 
                } else {
                    alert(data.message);
                }
            } catch (err) {
                console.error("Erreur suppression:", err);
            }
        }
    },

    mounted() {
        // Initialisation au chargement de la page
        this.checkSession();
        this.fetchProduits();
        this.fetchCategories();
    }
}).mount('#app')