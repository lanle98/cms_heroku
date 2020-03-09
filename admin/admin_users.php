<?php

require_once '../load.php';
$getUsers = getAllUsers();
$jsonResponse = array('users' => array());

while ($row = $getUsers->fetch(PDO::FETCH_ASSOC)) {
    $jsonRow = array(
        'id' => $row['user_id'],
        'username' => $row['user_name'],
        'password' => $row['user_pass'],
        'name' => $row['name'],
        'authority' => $row['authority'],
        'avatar' => $row['avatar']
    );

    array_push($jsonResponse['users'], $jsonRow);
}

echo json_encode($jsonResponse);
