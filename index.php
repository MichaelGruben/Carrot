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
                $_SESSION['userid'] = $user->getId();
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
    $recipe = new Recipe();
    $recipe->setName($title);
    $recipe->setEffort($effort);
    $recipe->assignCategory($category);
    $entityManager->persist($recipe);
    $entityManager->flush();
}
$carrotData = $_SESSION;
unset($carrotData['userid']);
echo "<script>window.carrotData=" . json_encode($carrotData) . "</script>";
include('dist/index.html');
