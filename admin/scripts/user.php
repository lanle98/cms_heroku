<?php

function createUser($fname, $username, $password, $authority, $avatar)
{
    $pdo = Database::getInstance()->getConnection();

    //TODO: build the proper SQL query with the information above
    //execute it to create a user in tbl_user

    //TODO: based on the execution result, if everything goes through
    //redirect to the index.php
    //Otherwise, return an error message
    $query_check_duplicate = "SELECT * FROM `tbl_user` WHERE user_name=:username";
    $set_check_duplicate = $pdo->prepare($query_check_duplicate);
    $get_check_duplicate = $set_check_duplicate->execute(
        array(
            ":username" => $username
        )
    );

    if ($set_check_duplicate->rowCount() > 0) {
        return 'Account is already created';
    } else {
        $query_createuser = 'INSERT INTO `tbl_user` (name,user_name,user_pass,authority,avatar)';
        $query_createuser .= ' VALUES(:fname,:username,:password,:authority,:avatar);';
        $create_user = $pdo->prepare($query_createuser);
        $create_user_result = $create_user->execute(
            array(
                ":fname" => $fname,
                ":username" => $username,
                ":password" => $password,
                ":authority" => $authority,
                ":avatar" => $avatar,

            )
        );
        if ($create_user_result) {
            return 'Signup successful';
        } else {
            return 'Something goes wrong...';
        }
    }
}


function getSingleUser($id)
{
    //TODO: set up database connection
    $pdo = Database::getInstance()->getConnection();

    //TODO: run the proper SQL query to fetch the user based on $id
    $query_user_id = 'SELECT * FROM `tbl_user` WHERE user_id = :id';


    //TODO: return the user data if the above query went through
    $get_user_id = $pdo->prepare($query_user_id);
    $fetch_user_id = $get_user_id->execute(
        array(
            ':id' => $id
        )
    );

    // echo $get_user_id->debugDumpParams();
    if ($fetch_user_id && $get_user_id->rowCount()) {
        return $get_user_id;
    } else {
        return false;
    }

    //otherwise, return some error messgae.
}

function editUser($id, $fname, $username, $password, $email)
{
    $pdo = Database::getInstance()->getConnection();
    $query = "UPDATE `tbl_user` SET user_fname=:fname,user_name=:username,user_pass=:password,user_email=:email";
    $query .= ' WHERE user_id = :id';

    $set_query = $pdo->prepare($query);
    $get_query = $set_query->execute(
        array(
            ':id' => $id,
            ':fname' => $fname,
            ':username' => $username,
            ':password' => $password,
            ':email' => $email

        )
    );

    // echo $set_query->debugDumpParams();
    if ($set_query) {
        $_SESSION['update'] = "update successful";
        redirect_to('index.php');
    } else {
        return 'Update Failed......';
    }
}
