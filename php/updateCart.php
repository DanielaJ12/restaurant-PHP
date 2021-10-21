<?php
session_start();
$products = $_POST['product_id'];
$qtys = $_POST['qty'];
foreach($products as $key => $product){
    foreach($_SESSION['cart'] as $key2 => $item){
        if($item['product_id']==$product){
            $_SESSION['cart'][$key2]['quantity'] = $qtys[$key];
        }
    }
}
