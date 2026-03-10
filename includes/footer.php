</main>
        <footer class="mt-10 py-6 text-center text-gray-400 text-sm">
            &copy; 2026 - Switch
        </footer>
    </div> <script>
        // On crée l'application Vue
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    titreSite: "Bienvenue sur Switch",
                    compteur: 0
                }
            }
        }).mount('#app');
    </script>
</body>
</html>