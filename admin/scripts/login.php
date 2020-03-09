
<?php
function login($username, $password, $ip)
{
    // return sprintf('You are trying username=>%s, password=>%s', $username, $password);

    $pdo = Database::getInstance()->getConnection();

    //Check existtance

    //TOFOL Finish the following quert to count how many users' with the username = $username
    $check_exist_query = 'SELECT COUNT(*) FROM `tbl_user` WHERE user_name = :username';
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute(
        array(
            ':username' => $username
        )
    );
    if ($user_set->fetchColumn() > 0) {
        $check_match_query = 'SELECT * FROM `tbl_user` WHERE user_name = :username';
        $check_match_query .= ' AND user_pass=:password';
        $user_match = $pdo->prepare($check_match_query);
        $user_match->execute(
            array(
                ':username' => $username,
                ':password' => $password

            )
        );
        while ($founduser = $user_match->fetch(PDO::FETCH_ASSOC)) {
            $id = $founduser['user_id'];
            $updateTable = "UPDATE tbl_user SET user_ip =:ip WHERE user_id = :id";
            $updateTableIP = $pdo->prepare($updateTable);
            $updateTableIP->execute(
                array(
                    ':ip' => $ip,
                    ':id' => $id
                )
            );
        }
        if (isset($id)) {
            return 'Login successful';
        } else {
            return 'Wrong pass';
        }
    } else {
        return 'User does not exist';
    }

    //check if match

}

function getAllUsers()
{
    $pdo = Database::getInstance()->getConnection();

    $get_users_query = "SELECT * FROM tbl_user";
    $results = $pdo->query($get_users_query);

    if ($results) {
        return $results;
    } else {
        'There is no user';
    }
}
