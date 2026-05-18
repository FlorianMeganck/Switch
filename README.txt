PROJET SWITCH - GUIDE TECHNIQUE

Ce fichier récapitule les informations de configuration et les points
d'entrée de l'application Switch, conformément aux consignes reçues.


1. FICHIERS DE CONFIGURATION (Accès Base de Données)

L'accès à la base de données relationnelle (MySQL via l'API PDO de PHP)
est centralisé et configuré à l'emplacement suivant :

* Fichier : /api/config.php
* Rôle : Contient les constantes de connexion (Hôte, Nom de la base,
         Identifiant, Mot de passe) et initialise l'instance de connexion.
         Ce fichier est inclus au début de chaque script de l'API via 
         l'instruction 'require_once' pour centraliser le flux de données.


2. POINTS D'ENTRÉE DE L'APPLICATION

L'application repose sur une architecture moderne et découplée (Client/Serveur)
avec les points d'entrée suivants :

A. Point d'entrée Frontend (Interface Utilisateur) :
   * Fichier : /index.html
   * Rôle : C'est le point d'accès principal pour l'utilisateur dans son
     navigateur. Il charge le framework progressif Vue.js, les styles 
     Tailwind CSS et initialise l'application globale (via app.js). C'est
     ici que se gère la navigation dynamique en mode "Single Page".

B. Points d'entrée Backend (Serveur / API) :
   * Fichier de lecture : /api/accueil.php
     - Rôle : Point d'entrée de récupération des données. Appelé de manière
       asynchrone (fetch) dès le démarrage pour charger le catalogue des
       produits disponibles à l'échange.
   * Fichier d'action critique : /api/acheter.php
     - Rôle : Point d'entrée transactionnel pour valider les achats, débiter
       les comptes et sécuriser l'échange d'un produit.
       

3. SCRIPTS D'ADMINISTRATION (Sauvegarde)

* Fichier : /sauvegarde_db.sh
* Rôle : Script automatisé (Bash) permettant de générer des sauvegardes
         régulières (toutes les heures) de la base de données. Ce script est conçu 
         pour être planifié via une tâche Cron sur le serveur.