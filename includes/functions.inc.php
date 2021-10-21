<?php
function emptyInputSignup($name, $surname, $user, $email, $phone, $address, $psw){
/*$result;
if (empty($name) || (empty($surname) || (empty($user) || (empty($email) || (empty($phone) || (empty($address) || (empty($psw))
{
     $result=true;
}
else{
    $result = false;
    }
    return $result;*/
    echo $name;
}
function invalidUid($user)
{
    $result;
    if (preg_match("/^[a-zA-Z0-9]*$/", $user)){
        $result = true;
    }
    else{
        $result=false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function uidExists($conn, $user){
    $sql = "SELECT * FROM p_user WHERE user = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_patam($stmt, "ss", $user);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;

    }
    else{
        $result = false;
        return $result;}
     mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $surname, $user, $email, $phone, $address, $psw){
    $sqlselect = "SELECT p_user.user FROM p_user JOIN p_client ON p_user.user = p_client.user;";
    $sql1 = "INSERT INTO p_user (user, parola) VALUES (?, ?);"
    $sql = "INSERT INTO p_client (nume, prenume, email, telefon, adresa, $sql1) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($psw, PASSWORD_DEFAULT);

    mysqli_stmt_bind_patam($stmt, "ss", $user, $email, $phone, $address, $hashedPwd);
    mysqli_stmt_execute($stmt);  
    mysqli_stmt_close($stmt);
    header("location: ../index.php?error=none");
    exit();
}
?>