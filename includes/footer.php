</main>
        <footer class="text-center py-10 text-slate-400 text-xs uppercase tracking-widest">
            &copy; 2026 — Switch Project
        </footer>
    </div> <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    // C'est ici qu'on mettra nos variables plus tard
                    pageTitle: 'Bienvenue sur Switch',
                    isLoggedIn: false
                }
            }
        }).mount('#app');
    </script>
</body>
</html>