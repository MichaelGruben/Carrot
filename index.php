<?php
session_start();
require_once "bootstrap.php";
// error_log(serialize($_POST), 0);

if (isset($_POST['eventLogin'])) {
    list('login' => $login, 'password' => $password) = $_POST;
    if ($login && $password) {
        $user = $entityManager->getRepository('User')
            ->findOneBy(array('email' => $login));
        if ($user) {
            $authenticated = $user->authenticate($password, "password_verify");
            if ($authenticated) {
                $_SESSION['username'] = $user->toUsername();
            }
        }
    }
}

if (isset($_POST['eventLogout']) && $_POST['logout'] === 'true') {
    session_reset();
    session_destroy();
    session_start();
}

if (isset($_POST['eventNewRecipe'])) {
    list('title' => $title, 'effort' => $effort, 'category' => $category) = $_POST;
    $_SESSION['newRecipe'] = ['title' => $title, 'effort' => $effort, 'category' => $category];
}
echo "<script>window.carrotData=" . json_encode($_SESSION) . "</script>";
include('dist/index.html');
