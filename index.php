<?php
session_start();
require_once "bootstrap.php";
error_log(serialize($_POST), 0);
$login = $password = '';
list('login' => $login, 'password' => $password, 'logout' => $logout) = $_POST;
error_log($logout, 0);
error_log($logout === 'true', 0);
if ($login && $password) {
    $user = $entityManager->getRepository('User')
        ->findOneBy(array('email' => $login));
    if ($user) {
        $authenticated = $user->authenticate($password, "password_verify");
        if ($authenticated) {
            $_SESSION['username'] = $user->toUsername();
        }
    }
} else if ($logout === 'true') {
    session_reset();
    session_destroy();
    session_start();
}
echo "<script>window.carrotData=".json_encode($_SESSION)."</script>";
include('dist/index.html');
