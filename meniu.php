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
		
	
	@media (max-width: 812px){
		.single-menu {
			
			display: flex;
			
		}
		
		.single-menu img {
			margin-top:0;
		}
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
                            <hr>Meniul Restaurantului
                            <hr>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="menu-box">
            <div class="container">
                <div class="row" id="meniu">
                    <div class="col-lg-12">
                        <div class="heading-title text-center">
                            <h2>Meniu online pentru toate gusturile.</h2>
                        </div>
                    </div>
                </div>
               
                <div class="row">
                   <?php 
                        if(!isset($_GET['typeCategory'])){
                            $typeCategory = 1;
                        }else{
                            $typeCategory = $_GET['typeCategory'];
                        }
                    
                    ?>
                    <div class="col-md-3">
                       <div class="btn-group btn-group-justified" role="group" aria-label="...">
                           <div class="btn-group" role="group">
                               <a href="meniu.php?typeCategory=1" type="button" class="btn <?php if($typeCategory==1){ echo 'btn-warning'; }else{ echo 'btn-default'; } ?>">Băuturi</a>
                           </div>
                           <div class="btn-group" role="group">
                               <a href="meniu.php?typeCategory=2" type="button" class="btn <?php if($typeCategory==2){ echo 'btn-warning'; }else{ echo 'btn-default'; } ?>">Mâncăruri</a>
                           </div>
                       </div><br>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <?php
                                $stmt = $sql->prepare("select * from p_category where idType=? order by name asc");
                                $stmt->bindParam(1, $typeCategory);
                                $stmt->execute();
                                $categories = $stmt->fetchAll();
                                if($stmt->rowCount()>0){
                                    foreach($categories as $category){
                            ?>
                            <a class="nav-link active" href="meniu.php?typeCategory=<?php echo $typeCategory; ?>&category=<?php echo $category['idCategory']; ?>" style="margin-bottom:15px"><?php echo $category['name']; ?></a>
                            <?php }} ?>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-lg-8">
                        <div class="">
                           <?php
                                if(!isset($_GET['category'])){
                                    $categoryName = $categories[0]['name'];
                                }else{
                                    $stmt = $sql->prepare("select * from p_category where idCategory=?");
                                    $stmt->bindParam(1, $_GET['category']);
                                    $stmt->execute();
                                    $category = $stmt->fetch();
                                    $categoryName = $category['name'];
                                }
                            ?>
                            <div class="title">
                                <h4><?php echo $categoryName; ?></h4>
                            </div>
                            <?php
                                if(isset($_GET['category'])){
                                    $category = $_GET['category'];
                                }else{
                                    $category = $categories[0]['idCategory'];
                                }
                                $stmt = $sql->prepare("select * from p_takepartfrom as a left join p_product as b on a.idProduct=b.idProduct where a.idCategory=?");
                                $stmt->bindParam(1, $category);
                                $stmt->execute();
                                $rows = $stmt->fetchAll();
                                if($stmt->rowCount()>0){
                                    foreach($rows as $row){
                            ?>
                            <div class="single-menu">
                                 <img src="img/<?php echo $row['image']; ?>" alt="poza">
                                <div class="menu-content" style="width:100%">
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
        elem.prop('disabled', true).html("Vă rugăm așteptați...");
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
                    toastr["success"]("Produsul a fost adăugat cu succes!");
                    elem.prop('disabled', false).html("Adaugă în coș.");
                    getCartItems();
                }, 1500);
            },
        });
    });
</script>

</html>