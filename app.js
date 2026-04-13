const { createApp } = Vue

createApp({
    data() {
        return {
            page: 'accueil',
            currentUser: null,
            error: '',
            
            produits: [],
            categories: [], 
            selectedProduct: null, // Produit actuellement regardé
            selectedFile: null,    // Fichier image en cours d'upload
            showPassLogin: false,    // État pour la connexion
            showPassRegister: false,
            
            // -- FORMULAIRES --
            login_form: { email: '', password: '', remember: false },
            register_form: { username: '', email: '', password: '' },
            
            vendreForm: {
                name: '',
                category_id: '',
                new_category_name: '',
                description: '',
                price: '',
                condition: 'Bon état'
            },

            editForm: {
                id: null,
                name: '',
                category_id: '',
                new_category_name: '',
                description: '',
                price: '',
                condition: '',
                current_image: null 
            }
        }
    },
    
    methods: {
        // 1. NAVIGATION & INTERFACE
        voirProduit(produit) {
            this.selectedProduct = produit;
            this.page = 'detail_produit';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },

        revenirAuTroc() {
            this.selectedProduct = null;
            this.page = 'troc';
        },

        // 2. AUTHENTIFICATION & SESSION
        async checkSession() {
            try {
                const response = await fetch('api/check_session.php');
                const data = await response.json();
                if (data.connected) {
                    this.currentUser = data.user;
                }
            } catch (err) {
                console.error("Erreur session:", err);
            }
        },

        async login() {
            if (!this.login_form.email || !this.login_form.password) {
                this.error = 'Veuillez remplir tous les champs.';
                return;
            }
            try {
                const response = await fetch('api/connexion.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(this.login_form)
                });
                const data = await response.json();

                if (data.success) {
                    this.currentUser = data.user;
                    this.login_form = { email: '', password: '', remember: false };
                    this.page = 'accueil';
                    this.error = '';
                } else {
                    this.error = data.message;
                }
            } catch (err) {
                this.error = "Erreur de connexion au serveur";
            }
        },

        async register() {
            try {
                const response = await fetch('api/inscription.php', { 
                    method: 'POST', 
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(this.register_form) 
                });
                const data = await response.json();

                if (data.success) {
                    this.currentUser = data.user;
                    this.register_form = { username: '', email: '', password: '' };
                    this.page = 'accueil';
                    this.error = '';
                } else {
                    this.error = data.message;
                }
            } catch (err) {
                this.error = "Erreur lors de l'inscription.";
            }
        },

        async logout() {
            await fetch('api/deconnexion.php');
            this.currentUser = null;
            this.page = 'accueil';
        },

        // 3. RÉCUPÉRATION DES DONNÉES
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

        // 4. ACTIONS SUR LES PRODUITS
        handleFileUpload(event) {
            this.selectedFile = event.target.files[0];
        },

        async vendreProduit() {
            const formData = new FormData();
            for (let key in this.vendreForm) {
                formData.append(key, this.vendreForm[key]);
            }
            if (this.selectedFile) {
                formData.append('product_image', this.selectedFile);
            }

            try {
                const response = await fetch('api/produit.php', { method: 'POST', body: formData });
                const data = await response.json();

                if (data.success) {
                    this.page = 'accueil';
                    this.fetchProduits();
                    this.vendreForm = { name: '', category_id: '', new_category_name: '', description: '', price: '', condition: 'Good' };
                } else {
                    this.error = data.message;
                }
            } catch (err) {
                this.error = "Erreur lors de l'envoi.";
            }
        },

        prepareEdit(produit) {
            this.editForm = { ...produit };
            this.editForm.current_image = produit.image;
            this.page = 'editer';
        },

        async modifierProduit() {
            const formData = new FormData();
            formData.append('product_id', this.editForm.id);
            formData.append('name', this.editForm.name);
            formData.append('category_id', this.editForm.category_id);
            formData.append('new_category_name', this.editForm.new_category_name);
            formData.append('description', this.editForm.description);
            formData.append('price', this.editForm.price);
            formData.append('condition', this.editForm.condition);

            if (this.selectedFile) {
                formData.append('product_image', this.selectedFile);
            }

            try {
                const response = await fetch('api/edition.php', { method: 'POST', body: formData });
                const data = await response.json();

                if (data.success) {
                    this.page = 'profil';
                    this.fetchProduits();
                } else {
                    this.error = data.message;
                }
            } catch (err) {
                this.error = "Erreur lors de la modification.";
            }
        },

        async supprimerProduit(id) {
            if (!confirm("Es-tu sûr de vouloir supprimer cet article ?")) return;

            const formData = new FormData();
            formData.append('product_id', id);

            try {
                const response = await fetch('api/suppression.php', { method: 'POST', body: formData });
                const data = await response.json();

                if (data.success) {
                    this.fetchProduits();
                } else {
                    this.error = data.message;
                }
            } catch (err) {
                console.error("Erreur suppression:", err);
            }
        },

        // 5. FONCTIONS PROFIL
        getMyLastProduct() {
            if (!this.currentUser) return null;
            return this.produits.find(p => p.seller_id == this.currentUser.id);
        },

        getMyProductsCount() {
            if (!this.currentUser) return 0;
            return this.produits.filter(p => p.seller_id == this.currentUser.id).length;
        }
    },

    mounted() {
        this.checkSession();
        this.fetchProduits();
        this.fetchCategories();
    }
}).mount('#app')