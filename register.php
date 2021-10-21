<?php
session_start();
if (isset($_POST["submit"])) {
    require_once 'includes/dbd.inc.php';
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $user = $_POST['user'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    

    if (empty($name) || empty($surname) || empty($user) || empty($email) || empty($address) ||empty($password)){
         $_SESSION['error'] = 1;
         $_SESSION['message'] = 'Toate campurile trebuie completate!';
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $_SESSION['error'] = 1;
         $_SESSION['message'] = 'Adresa de e-mail este incorectă!';
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
    }

    else if (!preg_match("/^[a-zA-Z0-9]*$/",$user)) {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = 'Utilizator invalid!';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    else{
        $sqlEmail = "SELECT * FROM p_client WHERE email=?";
            $stmt = $sql->prepare($sqlEmail);
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $_SESSION['error'] = 1;
                $_SESSION['message'] = 'Exista deja un utilizator cu acest email!';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
    }
    else {
        $query = "SELECT user FROM p_user WHERE user=?";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $user, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $_SESSION['error'] = 1;
            $_SESSION['message'] = 'User existent!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        else {
             $query = "INSERT INTO p_client (name, surname, email, phone, address, user) VALUES(?, ?, ?, ?, ?, ?)";
             $stmt = $sql->prepare($query);
             $stmt->bindParam(1, $name, PDO::PARAM_STR);
             $stmt->bindParam(2, $surname, PDO::PARAM_STR);
             $stmt->bindParam(3, $email, PDO::PARAM_STR);
             $stmt->bindParam(4, $phone, PDO::PARAM_STR);
             $stmt->bindParam(5, $address, PDO::PARAM_STR);
             $stmt->bindParam(6, $user, PDO::PARAM_STR);
             $stmt->execute();
             $clientId = $sql->lastInsertId();
            
             $query = "INSERT INTO p_user (idClient, user, password) VALUES(?, ?, ?)";
             $stmt = $sql->prepare($query);
             $stmt->bindParam(1, $clientId, PDO::PARAM_STR);
             $stmt->bindParam(2, $user, PDO::PARAM_STR);
             $stmt->bindParam(3, $password, PDO::PARAM_STR);
             $stmt->execute();
             
             $_SESSION['client'] = 1;
             $_SESSION['clientId'] = $clientId;
             $_SESSION['error'] = 0;
             $_SESSION['message'] = 'Înregistrare efectuată! Sunteți logat.';
             header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
}
