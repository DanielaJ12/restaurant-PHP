<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
<?php include 'includes/head.php'; ?>
	<style>
		.gallery img{
			width:100%;
			height:300px;
			object-fit:cover;
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

      <!-- Header -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1><hr>Galerie<hr></h1>
				</div>
			</div>
		</div>
    </div>
<!--Galerie-->
<div class="gallery">
	<div class="container">
		<ul class="row">
			<div class="col-lg-12">
			    <div class="heading-title text-center">
			        <center>
			            <h2 class="tit">Galeria restaurantului nostru</h2>
			            <br>
                    </center>
			    </div>
			</div>
	<li class="col-12 col-md-4 col-lg-4">
	<a href="img/gallery1.jpg" data-lightbox="mygallery" data-title="Meniul Marinarului"><img src="img/gallery1small.jpg" >
	</a>
	</li>
	<li class="col-sm-12 col-md-4 col-lg-4">
	<a href="img/gallery2.jpg" data-lightbox="mygallery" data-title="Somon cu legume"><img src="img/gallery2small.jpg" >
	</a>
	</li>
	<li class="col-sm-12 col-md-4 col-lg-4">
	<a href="img/gallery4.jpg" data-lightbox="mygallery" data-title="Prajitura cu frisca de casa"><img src="img/gallery4small.jpg" >
	</a>
	</li>
	</ul>

	<ul class="row">
	<li class="col-sm-12 col-md-4 col-lg-4">
	<a href="img/gallery5.jpg" data-lightbox="mygallery" data-title="Orez asezonat cu legume"><img src="img/gallery5small.jpg" >
	</a>
	</li>
	<li class="col-sm-12 col-md-4 col-lg-4">
	<a href="img/gallery6.jpg" data-lightbox="mygallery" data-title="Meniu complet"><img src="img/gallery6small.jpg" >
	</a>
	</li>
    <li class="col-sm-12 col-md-4 col-lg-4">
        <a href="img/gallery3.jpg" data-lightbox="mygallery" data-title="Ochi de ou pe pat de pasta de avocado"><img src="img/gallery3small.jpg" >
        </a>
	</li>
</ul>

	<ul class="row">
     <li class="col-sm-6 col-md-4 col-lg-4">
        <a href="img/gallery7.jpg" data-lightbox="mygallery" data-title="Mic dejun"><img src="img/gallery7small.jpg" >
        </a>
	</li>
    <li class="col-sm-6 col-md-4 col-lg-4">
        <a href="img/gallery8.jpg" data-lightbox="mygallery" data-title="Somon la cuptor"><img src="img/gallery8small.jpg" >
         </a>
        </li>
        <li class="col-sm-6 col-md-4 col-lg-4">
            <a href="img/gallery9.jpg" data-lightbox="mygallery" data-title="Omleta"><img src="img/gallery9small.jpg" >
            </a>
		</li>
	</ul>

	<ul class="row">
		<li class="col-sm-6 col-md-4 col-lg-4">
		   <a href="img/gallery10.jpg" data-lightbox="mygallery" data-title="Meniu fresh"><img src="img/gallery10small.jpg" >
		   </a>
	   </li>
	   <li class="col-sm-6 col-md-4 col-lg-4">
		   <a href="img/gallery11.JPG" data-lightbox="mygallery" data-title="Tocanita de legume"><img src="img/gallery11small.jpg" >
			</a>
		   </li>
		   <li class="col-sm-6 col-md-4 col-lg-4">
			   <a href="img/gallery12.jpg" data-lightbox="mygallery" data-title="Pasta fussion"><img src="img/gallery12small.jpg" >
			   </a>
		   </li>
	   </ul>
	   
	   <ul class="row">
		<li class="col-sm-6 col-md-4 col-lg-4">
		   <a href="img/gallery13.jpg" data-lightbox="mygallery" data-title="Prajitura de morcov"><img src="img/gallery13small.jpg" >
		   </a>
	   </li>
	   </ul>
            <div class="col-lg-4 col-md-4 col-sm-6 text-center">
				<center>
					<div  class="inner-column">
						<a align = "center" class="btn btn-lg btn-circle btn-outline-new-white" id="next">Mai mult</a>
	                </div>
	            </center>
            </div>
            <br><br>
	</div>
</div>
</main>
<!--Footer-->
<?php include 'includes/footer.php'; ?>
</body>
</html>