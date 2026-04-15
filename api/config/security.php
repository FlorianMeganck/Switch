<?php
// api/config/security.php

if (!empty($_SERVER['HTTPS'])) {
    header("Strict-Transport-Security: max-age=31536000");
}

ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Strict');

// lifetime 2 minutes
ini_set('session.cookie_lifetime', 1800);

// On démarre la session AVEC les règles de sécurité
session_start();