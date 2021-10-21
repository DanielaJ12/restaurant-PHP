<?php
session_start();
include 'includes/dbd.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
   <title>Restaurant</title>
    <?php include 'includes/head.php'; ?>
</head>

<body>
    <!--Log in-->
    <div id="bg_img" class="img_area"></div>
    <div class="main_section">
        <?php include 'includes/modals.php'; ?>
    </div>
    <!--Navigare-->
    <main id="blur">
        <?php include 'includes/nav.php'; ?>
        
        <div class="btn btn-warning" id="update_cart">
            <span>Actualizeză</span>
        </div>
        <!-- Header -->
        

        <div class="menu-box">
            <div class="container">
                
               
                <div class="row">
                    <div class="col-lg-8 col-md-offset-2">
                        <div class="">
                           
                            <div class="title">
                                <h4>Coșul de cumpărături</h4>
                            </div>
                            <form action="" id="cartForm">
                            <?php 
                            $total = 0;
                            if(isset($_SESSION['cart'])){
                                $cart_products = array();
                                foreach($_SESSION['cart'] as $cart){
                                    $query = "select * from p_product where idProduct = ?";
                                    $stmt = $sql->prepare($query);
                                    $stmt->bindParam(1, $cart['product_id'], PDO::PARAM_STR);
                                    $stmt->execute();
                                    $item = $stmt->fetch();
                                    $total+=($item['price']*$cart['quantity']);
                            ?>
                            <div class="single-menu">
                                <img src="img/<?php echo $item['image']; ?>" alt="poza">
                                <div class="menu-content">
                                    <h4><?php echo $item['name']; ?><span><br>
                                    Total: 
                                    <?php echo $item['price']; ?> lei x <?php echo $cart['quantity']; ?> = <?php echo $item['price']*$cart['quantity']; ?> Lei 
                                    </span></h4>
                                    <?php echo $item['description'];?><span><br>
                                    <button type="button" data-price="<?php echo $item['price']; ?>" data-productid="<?php echo $item['idProduct']; ?>" class="qty-up border btn-warning btn"><i class="fas fa-angle-up"></i></button>
                                    <input type="text" class="qty_input_<?php echo $item['idProduct']; ?> text-center border px-2 w-50 bg-light" readonly value="<?php echo $cart['quantity']; ?>" placeholder="1" min="1" name="qty[]">
                                    <input type="hidden" name="product_id[]" value="<?php echo $item['idProduct']; ?>">
                                    <button type="button" data-price="<?php echo $item['price']; ?>" data-productid="<?php echo $item['idProduct']; ?>" class="qty-down border btn btn-warning"><i class="fas fa-angle-down"></i></button>
                                    <button type="button" class="btn btn-danger remove" data-productId="<?php echo $item['idProduct']; ?>">Șterge</button>
                                </div>
                                
                            </div>
                            <?php }} ?>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="row bg-white rounded ">
                    <div class="col-lg-6 col-md-offset-3">
                        <div class="panel panel-warning">
                            <div class="panel-heading" style="background:#f0ad4e;border-color:#f0ad4e;color:white"><h4>Detaliile Comenzii</h4></div>
                            <div class="panel-body" style="background:#666666;color:white">
                                <h3>Total: <span class="pull-right"><?php echo $total; ?> Lei</span></h3>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if(isset($_SESSION['client'])){ 
                            if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
                    ?>
                    <div class="col-lg-6 col-md-offset-3">
                        <a href="checkout.php" class="btn btn-warning rounded-pill py-2 btn-block">Plasează comanda</a>
                    </div>
                    <?php }}else{ ?>
                    <div class="col-lg-6 col-md-offset-3">
                        <button onclick="openform()" class="btn btn-warning rounded-pill py-2 btn-block">Autentifică-te pentru a plasa comanda.</button>
                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>
        <!--Footer-->
        <?php include 'includes/footer.php'; ?>


    </main>
</body>
<script>
$(".qty-up").click(function(){
    var input = $(this).data('productid');
    var price = $(this).data('price');
    var qty = $(".qty_input_"+input).val();
    qty++;
    var total = qty*price;
    $("#product_total_"+input).html(total.toFixed(2))
    $(".qty_input_"+input).val(qty);
    updateTotal();
});

$(".qty-down").click(function(){
    var input = $(this).data('productid');
    var price = $(this).data('price');
    var qty = $(".qty_input_"+input).val();
    qty--;

    if(qty<1){
        return false;
    }
    var total = qty*price;
    $("#product_total_"+input).html(total.toFixed(2))
    $(".qty_input_"+input).val(qty);
    updateTotal();
});

$("#update_cart").click(function(){
    var elem = $(this);
    $.ajax({
        url : 'php/updateCart.php',
        type : 'POST',
        data : $("#cartForm").serialize(),
        success : function(data) {
            alert('Coșul a fost actualizat!');
            window.location="cart.php";
        },
    });
});   


$(".remove").click(function(){
    if(!confirm('Sunteți sigur/ă că doriți să ștergeți acest produs?')){
        return false;
    }
    var elem = $(this);
    var product_id = elem.attr('data-productId');
    $.ajax({
        url : 'php/removeFromCart.php',
        type : 'POST',
        data : {
            removeFromCart : 1,
            product_id: product_id,
        },
        success : function(data) {
            //toastr["success"]("Removed from cart");
            alert('Produsul a fost șters.');
            window.location="cart.php";
        },
    });
});
    
function updateTotal(){
    var total = 0;
    $('.total').each(function(i, obj) {
        total+=parseFloat($(this).html());
    });
    $("#sum_total").html(total.toFixed(2));
}

    

</script>

</html>