<?php
session_start();
include 'includes/dbd.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">

    <!-- Site Metas -->
    <title>Restaurant</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--BOOSTRAP-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--LightBoxGalerry-->
    <link rel="stylesheet" type="text/css" href="css/lightbox.min.css">

    <link rel="stylesheet" href="css/style.css">
    <!--JS FILE-->
    <script src="js/more.js"></script>
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/logformopen.js"></script>
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
    #update_cart {
        text-align: left;
        position: fixed;
        bottom: 50px;
        right: 50px;
       
        border-radius: 25px;
        z-index: 99999;
    }
        
        .form-control{
            color: white;
        }
    
    </style>
</head>

<body>
    <!--Log in-->
    <div id="bg_img" class="img_area"></div>
    <div class="main_section">
        <section id="section">
            <div class="cont">
                <div class="user singinBx">
                    <div class="imgBx"><img src="img/log1.jpg"></div>
                    <div class="formBx">
                        <form>
                            <span style="position: absolute; right : 30px; top :30px; cursor: pointer;"><i onclick="toggle()" class="fas fa-times-circle"></i></span>
                            <h2>Logare</h2>
                            <input type="text" name="" placeholder="Utilizator">
                            <input type="password" name="" placeholder="Parola">
                            <input type="submit" name="" value="Logheaza-te">
                            <p class="signup">Nu ai cont?<a href="#" onclick="toggleForm();"> Inregistreaza-te</a></p>
                        </form>
                    </div>
                </div>
                <div class="user singupBx">
                    <div class="formBx">
                        <form method="post" action="register.php">
                            <span style="position: absolute; right : 30px; top :30px; cursor: pointer;"><i onclick="toggle()" class="fas fa-times-circle"></i></span>
                            <h2>Creare cont</h2>
                            <input required type="text" name="name" placeholder="Nume">
                            <input required type="text" name="surname" placeholder="Prenume">
                            <input required type="text" name="email" placeholder="Email">
                            <input type="tel" name="phone" id="phone" placeholder="798-555-211" maxlength="10">
                            <input required type="text" name="address" placeholder="Adresa">
                            <input required type="text" name="user" placeholder="User">
                            <input required type="password" name="password" placeholder="Parola">
                            <input type="submit" name="submit" value="Inregistreaza-te">
                            <p class="signup">Ai deja cont?<a href="#" onclick="toggleForm();"> Autentifica-te</a></p>
                        </form>
                    </div>
                    <div class="imgBx"><img src="img/log2.jpg"></div>
                </div>
            </div>
        </section>
    </div>
    <!--Navigare-->
    <main id="blur">
        <?php include 'includes/nav.php'; ?>
        
        
        <!-- Header -->
        

        <div class="menu-box">
            <div class="container">
                
               
                <div class="row">
                    <div class="col-lg-8 col-md-offset-2">
                        <div class="">
                           
                            <div class="title">
                                <h4>Multumim!</h4>
                                <p>Comanda a fost plasată cu succes.</p>
                            </div>
                            
                            <center>
                                <a href="meniu.php" class="btn btn-warning">Plaseză o nouă comandă</a>
                            </center>
                            <br>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
        <!--Footer-->
        <footer class="footer-area bg-f">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <h3>Despre</h3>
                        <p>Ne place sa credem ca restaurantul reprezinta combinatia excelenta dintre starea de bine, contrastele naturii si serviciile premium de restaurant pe care le oferim cu tot dragul oaspetilor nostri! </p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3>Aboneaza-te</h3>
                        <div class="subscribe_form">
                            <form class="subscribe_form">
                                <input name="EMAIL" id="subs-email" class="form_input" placeholder="Adresa de email..." type="email">
                                <button type="submit" class="submit">Aboneaza-te</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <ul class="list-inline f-social">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3>Contact</h3>
                        <p class="lead">Strada WWW, Nr1A, Galati, 101000</p>
                        <p class="lead"><a href="#">+40 yyyy yyyy</a></p>
                        <p><a href="#"> admin@gmail.com</a></p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3>Program</h3>
                        <p><span class="text-color">Luni-Vineri </span>10:00 - 22:30</p>
                        <p><span class="text-color">Samabata-Duminica</span>10:00 - 23:00</p>
                    </div>
                </div>
            </div>

            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="company-name">Drepturi rezervate &copy; 2020||2021 <a href="#">Restaurant</a> Design : Daniela</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>



</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>
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
            //toastr["success"]("Cart Updated");
            alert('Cart updated');
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

<?php if(isset($_SESSION['message'])){ 
    if($_SESSION['error']==1){
        $type = 'error';
    }else{
        $type = 'success';
    }
?>
toastr["<?php echo $type; ?>"]("<?php echo $_SESSION['message']; ?>");
<?php unset($_SESSION['message']); unset($_SESSION['error']); } ?>
    

</script>

</html>