<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once '../load.php';
$ip = $_SERVER['REMOTE_ADDR'];



$username = trim($_POST['user_name']);
$password = trim($_POST['user_pass']);

if (!empty($username) && !empty($password)) {
    //Do the login here
    $message = login($username, $password, $ip);
    echo json_encode($message);
} else {
    $message = "Please fill in the required fields";
    echo json_encode($message);
}
