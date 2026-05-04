<?php

if (!empty($_SERVER['HTTPS'])) {
    header("Strict-Transport-Security: max-age=31536000"); //Bon pour un an
}

ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Strict');

ini_set('session.cookie_lifetime', 0); //Lifetime de 0 car cookie supprimé dés la fermeture

// On démarre la session avec les règles de sécurité
session_start();
