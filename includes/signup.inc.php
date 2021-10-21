<?php
if (isset($_POST["signup-submit"])) {

    require_once 'dbd.inc.php';

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $user = $_POST['user'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $psw = $_POST['psw'];

    if (empty($name) || empty($surname) || empty($user) || empty($email) || empty($address) ||empty($psw)){
        header("Location: ../index.php?error=Toate campurile trebuie completate!");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && (!preg_match("/^[a-zA-Z0-9]*$/",$user)) {
        header("Location: ../index.php?error=emailsauUserInvalid");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=emailInvalid&user=".$user);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/",$user)) {
        header("Location: ../index.php?error=emailInvalid&user=".$email);
        exit();
    }
    else {
        $sql = "SELECT user FROM p_user WHERE user=?";
        $stat = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows();
            if($resultCheck > 0){
                header("Location: ../index.php?error=User existent!");
                exit();
            }
            else {
                $sql = "INSERT INTO p_user (parola, idClient) VALUES(?, ?, ?)";
                $stat = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt)){
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                }
                else {
                    

                }

            }
        }

    }
}