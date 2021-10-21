<?php
session_start();
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

$product['product_id'] = $_POST['product_id'];
$product['quantity'] = 1;
$updated = checkCartForProduct($product, $_SESSION['cart']);
if($updated==0){
    $_SESSION['cart'][] = $product;
    echo 'added';
}else{
    echo 'updated';
}

function checkCartForProduct($product, $cart) {
   
    $updated = 0;
    foreach($_SESSION['cart'] as $key => $item){
        if($item['product_id']==$product['product_id']){
            $_SESSION['cart'][$key]['quantity']+=$product['quantity'];
            $updated = 1;
        }
    }
    return $updated;
}
?>