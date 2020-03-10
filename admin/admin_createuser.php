<?php

require_once '../load.php';


$fname = trim($_POST['name']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$authority = 'parents';
$avatar = trim($_POST['avatar']);

if (empty($fname) || empty($username) || empty($password)) {
    $message = 'Please fill required fields';
} else {
    $message = createUser($fname, $username, $password, $authority, $avatar);
}
echo json_encode($message);
