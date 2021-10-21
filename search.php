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
    <style>
    #items_box {
        text-align: left;
        position: fixed;
        bottom: 50px;
        right: 50px;
        width: 22%;
        border-radius: 25px;
        z-index: 99999;
    }
		
	.form-control{
		color:white !important;
	}
    
    </style>
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
        
        <div onclick="window.location='cart.php'" class="btn btn-warning" id="items_box">
            <span id="cartQty">0</span> PRODUSE <span class="pull-right">VEZI COȘUL <i class="fa fa-chevron-right"></i></span>
        </div>
        <!-- Header -->
        <div class="all-page-title page-breadcrumb">
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>
                            <hr>CAUTĂ
                            <hr>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="menu-box">
            <div class="container">
                <div class="row" id="meniu">
                    <div class="col-lg-6 col-md-offset-3">
                        <div class="heading-title text-center">
                            <h2>Caută &icirc;n meniul nostru</h2>
							<form method="get">
								<div class='form-group'>
									<input type="text" class="form-control" name="q" placeholder="Caută...">
								</div>
								<button class="btn btn-warning">Caută</button>
							</form>
                        </div>
                    </div>
                </div>
               
                <div class="row">
                   
                    
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="">
                           
                            <div class="title">
                                <h4>Rezultat pentru: <?php echo $_GET['q']; ?></h4>
                            </div>
                            <?php
                                
                                $stmt = $sql->prepare("select * from p_takepartfrom as a left join p_product as b on a.idProduct=b.idProduct where b.name like ? OR description like ?");
								$q = "%".$_GET['q']."%";
                                $stmt->bindParam(1, $q);
								$stmt->bindParam(2, $q);
                                $stmt->execute();
                                $rows = $stmt->fetchAll();
                                if($stmt->rowCount()>0){
                                    foreach($rows as $row){
                            ?>
                            <div class="single-menu">
                            <img src="img/<?php echo $row['image']; ?>" alt="poza">
                                <div class="menu-content">
                                    <h4><?php echo $row['name']; ?><span><?php echo $row['price']; ?> lei</span></h4>
                                    <p><?php echo $row['description']; ?></p>
                                    <button data-productId="<?php echo $row['idProduct']; ?>" class="btn btn-warning addtocart">Adaugă în coș</button>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>
        <!--Footer-->
        <?php include 'includes/footer.php'; ?>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
function getCartItems(){
    $.ajax({
        url: 'php/getCartItems.php',
        type: 'GET',
        success: function(data) {
            $("#cartQty").html(data);
        },
    });
}
    
getCartItems();
</script>
<script>
$('html, body').animate({
        scrollTop: $("#meniu").offset().top
    }, 500);
</script>
<script>
    $(document).on('click', '.addtocart', function() {
        var elem = $(this);
        elem.prop('disabled', true).html("Please wait");
        var product_id = elem.attr('data-productId');
        $.ajax({
            url: 'php/addToCart.php',
            type: 'POST',
            data: {
                addToCart: 1,
                product_id: product_id,
                quantity: 1,
            },
            success: function(data) {
                setTimeout(function() {
                    toastr["success"]("Added to cart");
                    elem.prop('disabled', false).html("Add to cart");
                    getCartItems();
                }, 1500);
            },
        });
    });
</script>

</html>