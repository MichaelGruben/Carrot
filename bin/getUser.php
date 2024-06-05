<?php
// create_user.php
require_once "bootstrap.php";

$email = $argv[1];
$password = $argv[2];

$user = $entityManager->getRepository('User')
                         ->findOneBy(array('email' => $email));

echo "Authenticated User by email and password " . $user->authenticate($password, "password_verify") . "\n";