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
        echo "Authenticated User by email and password " . $authenticated . "\n";
        if ($authenticated) {
            echo "Hallo " . $user->toUsername();
            $_SESSION['username'] = $user->toUsername();
        }
    }
} else if ($logout === 'true') {
    error_log('ending session', 0);
    session_reset();
    session_destroy();
}
echo "<script>window.carrotData=".json_encode($_SESSION)."</script>";
include('dist/index.html');
