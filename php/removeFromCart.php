<?php
session_start();
$product = $_POST['product_id'];
foreach($_SESSION['cart'] as $key => $item){
    if($item['product_id']==$product){
        unset($_SESSION['cart'][$key]);
    }
}