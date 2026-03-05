<?php include 'includes/header.php'; ?>

<section style="max-width: 400px; margin: 40px auto; text-align: left;" x-data="{ tab: 'login' }">
    
    <div style="display: flex; justify-content: space-around; margin-bottom: 30px; border-bottom: 2px solid #eee;">
        <button @click="tab = 'login'" :style="tab === 'login' ? 'border-bottom: 2px solid #42b883; color: #42b883; font-weight: bold;' : ''" style="background: none; border: none; padding: 10px; cursor: pointer; flex: 1;">Connexion</button>
        <button @click="tab = 'register'" :style="tab === 'register' ? 'border-bottom: 2px solid #42b883; color: #42b883; font-weight: bold;' : ''" style="background: none; border: none; padding: 10px; cursor: pointer; flex: 1;">Créer un compte</button>
    </div>

    <div x-show="tab === 'login'">
        <h2>Bon retour !</h2>
        <form action="traitement_connexion.php" method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Email étudiant :</label>
                <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Mot de passe :</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <button type="submit" class="btn" style="width: 100%; border: none; cursor: pointer;">Se connecter</button>
        </form>
    </div>

    <div x-show="tab === 'register'" x-cloak>
        <h2>Bienvenue sur Switch</h2>
        <form action="traitement_inscription.php" method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Nom complet :</label>
                <input type="text" name="nom" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Email étudiant :</label>
                <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Choisir un mot de passe :</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <button type="submit" class="btn" style="width: 100%; border: none; cursor: pointer; background-color: #2c3e50;">Créer mon compte</button>
        </form>
    </div>

</section>

<?php include 'includes/footer.php'; ?>