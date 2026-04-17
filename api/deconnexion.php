<?php
require_once __DIR__ . '/config/security.php';

$_SESSION = array();
session_destroy();

// On supprime le cookie de session
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path']);
}

// Suppression du cookie "remember_user"
setcookie('remember_user', '', time() - 42000, '/');

// Réponse JSON
header('Content-Type: application/json');
echo json_encode(['success' => true]);
exit;