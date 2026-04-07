<?php
session_start();

$_SESSION = array();

session_destroy();

if ($_GET['action'] == 'logout') {

    if (ini_get('session.use_cookies')) {
       $params = session_get_cookie_params();
       setcookie(
         session_name(),
         '',
         time() - 42000,
         $params['path']
       );
     }

echo json_encode(['success' => true]);
exit;
?>