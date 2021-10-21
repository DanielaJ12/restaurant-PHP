<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
<title>Restaurant</title>
<?php include 'includes/head.php'; ?>
</head> 
<body>
<!--Log in-->

<div class="main_section">
    <?php include 'includes/modals.php'; ?>
</div>
<!--Navigare-->
<main id="blur">
    <?php include 'includes/nav.php'; ?>
      <!-- Header -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1><hr>Contact<hr></h1>
				</div>
			</div>
		</div>
    </div>
<!--Info contact-->
<div class="contact-imfo-box">
    <div class="container">
        <div class="row">
            <center>

                <div class="col-md-4">
                    <i class="fa fa-volume-control-phone"></i>
                    <div class="overflow-hidden">
                        <h4>Telefon</h4>
                        <p class="lead">
                            +40 yyyy yyyy
                        </p>
                    </div>
                    <center><img class="roata" src="img/nxt.png" style="margin-bottom: 25px;"></center>
                </div>
                
                <div class="col-md-4">
                    <i class="fa fa-envelope"></i>
                    <div class="overflow-hidden">
                        <h4>Email</h4>
                        <p class="lead">
                            admin@gmail.com
                        </p>
                    </div>
                    <center><img class="roata" src="img/nxt.png" style="margin-bottom: 25px;"></center>
                </div>
                
                <div class="col-md-4">
                    <i class="fa fa-map-marker"></i>
                    <div class="overflow-hidden">
                        <h4>Locatie</h4>
                        <p class="lead">
                            Strada WWW, Nr1A, Galati, 101000
                        </p>
                    </div>
                </div>

            </center>
        </div>
    </div>
</div>
<!-- End Info contact-->
<!--Send message-->
<div class="reservation-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-title text-center">
                    <h2>Trimite-ne un mesaj</h2>
                    <p>Pentru orice intrebare, nu ezitati sa ne contactati.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form id="contactForm" name="contact-form" action="sendmailContact.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" required="required" id="contact-surname" placeholder="Nume Prenume">
                            </div>                                 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" required="required" id="contact-email" placeholder="Email">
                            </div> 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group"> 
                                <textarea class="form-control" id="message" placeholder="Mesajul tau" name="message" required="required" id="contact-message" cols="70" rows="6"></textarea>
                            </div>
                            <div class="submit-button text-center"> 
                                <input class="btn btn-common" type="submit" value="Trimite" >
                            </div>
                        </div>
                    </div>            
                </form>
            </div>
        </div>
    </div>
</div>
</main>
<!--Footer-->
<?php include 'includes/footer.php'; ?>

</body>
</html>