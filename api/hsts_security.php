<?php
// On configure les cookies de session AVANT de démarrer la session
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // Uniquement si tu es bien en HTTPS
ini_set('session.cookie_samesite', 'Strict');

// Durée de vie (120 secondes = 2 minutes)
ini_set('session.cookie_lifetime', 120);

// On démarre enfin la session avec ces paramètres
session_start();