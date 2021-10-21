<?php
/**
 * Ajax functie pentru a arata nr total de produse in cos
 */
session_start();
include '../classes/Products.php';
$product = new Products();
echo $product->getCartTotalItems();
?>