<?php
session_start();
if (isset($_POST["submit"])) {
    require_once 'includes/dbd.inc.php';
    $user = $_POST['user'];
    $password = $_POST['password'];
    if (empty($user) || empty($password)){
         $_SESSION['error'] = 1;
         $_SESSION['message'] = 'Toate campurile trebuie completate!';
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
    }
    else {
        $query = "SELECT * FROM p_user WHERE user=?";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $user, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $user = $stmt->fetch();
            if($password==$user['password']){
                
                if($user['role']=='admin'){
                    $_SESSION['admin'] = 1;
                    header('Location: admin/index.php');
                    exit;
                }else{
                    $_SESSION['error'] = 0;
                    $_SESSION['message'] = 'Autentificare reusită.';
                    $_SESSION['client'] = 1;
                    $_SESSION['clientId'] = $user['idClient'];
                }
                
            }else{
                $_SESSION['error'] = 1;
                $_SESSION['message'] = 'Utilizator sau parolă incorectă.';
            }
            
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }else{
            $_SESSION['error'] = 1;
            $_SESSION['message'] = 'Parola sau utilizator incorect!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}