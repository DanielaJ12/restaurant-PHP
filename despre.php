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
	<div id="bg_img" class="img_area"></div>
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
					<h1><hr>Despre noi<hr></h1>
				</div>
			</div>
		</div>
    </div>
<!--Despre-->
    <div class="about-section-box">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 text-center">
            <div class="inner-column">
             <center><hr> <h1>Bine ati venit la <br><span>Restaurant</span> </h1><hr>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;Va asteaptam intr-o ambianta deosebit de placuta si va stam la dispozitie cu serviciile de o foarte buna calitate. Preparatele noastre va vor incanta papilele gustative.
                Peste 30 de feluri de preparate si un bogat sortiment de bauturi garanteaza satisfacerea gusturilor dumneavoastra.<br>&nbsp;&nbsp;&nbsp;&nbsp;Cele mai bune preparate pentru tine, le livrăm atât acasă sau la birou, fie că ești cu familia, colegii sau prietenii tăi dragi. Livrăm prin flotă proprie, non-stop, avem super oferte, la super preturi. </p>
              <p class = "rec">Rezerva acum o masa si convinge-te singur.</p><br><br>
              <a class="btn btn-lg btn-circle btn-outline-new-white" href="rezerva.php">Rezerva</a></center>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <img src="img/Rest-about-HD.jpg" alt="Poza restaurant" class="img-fluid">
          </div> 
          <div class="col-md-12">
            <div class="inner-pt">
              <br>
              <center><p>Activam de mai bine de 10 ani in domeniul culinar. Ne place sa credem ca restaurantul reprezinta combinatia excelenta dintre starea de bine, contrastele naturii si serviciile premium de restaurant pe care le oferim cu tot dragul oaspetilor nostri!</p></center>
            </div>
          </div>     
        </div>
      </div>
    </div>
    
</main>
<!--Footer-->
<?php include 'includes/footer.php'; ?>

</body>
</html>