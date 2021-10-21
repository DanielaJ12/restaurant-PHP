<?php
session_start();
include 'includes/dbd.inc.php';
if(isset($_SESSION['cart'])){
    $time = date('H:i');
    $date = date('Y-m-d');
    $stmt = $sql->prepare("INSERT into p_order (dateOrder, timeOrder, idClient, name, phone, address, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $date);
    $stmt->bindParam(2, $time);
    $stmt->bindParam(3, $_SESSION['clientId']);
    $stmt->bindParam(4, $_POST['name']);
    $stmt->bindParam(5, $_POST['phone']);
    $stmt->bindParam(6, $_POST['address']);
    $stmt->bindParam(7, $_POST['note']);
    $stmt->execute();
    $orderId = $sql->lastInsertId();
    $total = 0;
    foreach($_SESSION['cart'] as $cart){
        $query = "select * from p_product where idProduct = ?";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $cart['product_id'], PDO::PARAM_STR);
        $stmt->execute();
        $item = $stmt->fetch();
        $total+=($item['price']*$cart['quantity']);
        $stmt = $sql->prepare("INSERT into p_choose (idOrder, idProduct, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $orderId);
        $stmt->bindParam(2, $item['idProduct']);
        $stmt->bindParam(3, $cart['quantity']);
        $stmt->bindParam(4, $item['price']);
        $stmt->execute();
    }

    $query = "update p_order set payment = ? where idOrder=?";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $total, PDO::PARAM_STR);
    $stmt->bindParam(2, $orderId, PDO::PARAM_STR);
    $stmt->execute();
    unset($_SESSION['cart']);
    header("location:thank-you.php?idOrder=".$orderId);
    die();
}
