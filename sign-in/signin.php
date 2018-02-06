<?php
ini_set("session.save_path", "/home/unn_w16003995/sessionData");
session_start();



$username = filter_has_var(INPUT_POST, 'username')
    ? $_POST['username'] : null;

$password = filter_has_var(INPUT_POST, 'password')
    ? $_POST['password'] : null;

$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

try {
    require_once("../php/functions.php");
    $dbConn = getConnection();

    $sql = "SELECT passwordHash 
            FROM nbc_users
            WHERE username = :username";

    $stmt = $dbConn->prepare($sql);
    $stmt->execute(array(':username' => $username));

    $recordObj = $stmt->fetchObject();
    if ($recordObj) {
        $passwordHash = $recordObj->passwordHash;

        if (password_verify($password, $passwordHash)){
            $_SESSION['signed-in'] = true;
            if ($_SESSION['origin_url'] != null) {
                header("Location: {$_SESSION['origin_url']}");
            }
            else {
                header('Location: ../edit');
            }
        }
        else{
            echo invalidPassword();

        }
    }
    else {
        echo invalidPassword();
    }
}
catch (Exception $e){
    if ($onDevelopment) {
        echo "<p>Query failed: ".$e->getMessage()."</p>\n";
    }
    else{
        $errors[] = "A problem occurred. Try again later.";
        $_SESSION['errors'] = $errors;
        header('Location: ../sign-in');
    }

}

?>
