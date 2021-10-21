<?php
session_start();
if (isset($_POST)) {
    require_once 'includes/dbd.inc.php';
    $date = $_POST['date'];
    $table = $_POST['table'];
    $time = $_POST['time'];
    if (empty($date) || empty($time) || empty($table)){
         $_SESSION['error'] = 1;
         $_SESSION['message'] = 'Toate campurile trebuie completate!';
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
    }
    else {
        $query = "SELECT * FROM p_booking WHERE timeBooking=? AND idTable=? AND dateBooking=?";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $time, PDO::PARAM_STR);
        $stmt->bindParam(2, $table, PDO::PARAM_STR);
        $stmt->bindParam(3, $date, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $tabledata = $stmt->fetch();
            $_SESSION['error'] = 1;
            $_SESSION['message'] = 'Ora indisponibila.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        else {
             
             $query = "INSERT INTO p_booking (dateBooking, timeBooking, idClient, idTable) VALUES(?, ?, ?, ?)";
             $stmt = $sql->prepare($query);
             $stmt->bindParam(1, $date, PDO::PARAM_STR);
             $stmt->bindParam(2, $time, PDO::PARAM_STR);
             $stmt->bindParam(3, $_SESSION['clientId'], PDO::PARAM_STR);
             $stmt->bindParam(4, $table, PDO::PARAM_STR);
             $stmt->execute();
             $_SESSION['error'] = 0;
             $_SESSION['message'] = 'Rezervare finalizata cu succes. Va fi confirmată curând.';
             header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}