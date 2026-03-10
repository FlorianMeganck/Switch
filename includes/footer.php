</main>
    </div> <script>
        // Ce script est le "démarreur" de ta voiture
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    statut: "Vue.js est bien activé ! ✅",
                    compteur: 0
                }
            }
        }).mount('#app');
    </script>
</body>
</html>