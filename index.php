<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Restaurant</title>
    <?php include 'includes/head.php'; ?>
    <style>
        .navbar{
            margin-bottom: 0 !important;
        }
		
		.gallery img{
			width:100%;
			height:250px;
			object-fit:cover;
		
		}
		
    </style>
</head>

<body>

    <!--navigare-->
    <!--<div id="bg_img" class="img_area"></div>-->
    <div class="main_section">
        <?php include 'includes/modals.php'; ?>
    </div>

    <main id="blur">

        <?php include 'includes/nav.php'; ?>
        <!--slides-->
        <center>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" contenteditable="false"></li>
                    <li data-target="#myCarousel" data-slide-to="1" class="active" contenteditable="false"></li>
                    <li data-target="#myCarousel" data-slide-to="2" contenteditable="false"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">

                    <div class="item active">
                        <img src="img/slide1.jpg" alt="s1">
                        <div class="carousel-caption">
                            <h3><strong>Bine ai venit la Restaurant!</strong></h3>
                            <p><a class=" btn btn-lg btn-circle btn-outline-new-white wtp_ab" href="rezerva.php">Rezervă</a>

                                <p><a class=" btn btn-lg btn-circle btn-outline-new-white wtp_ab" href="meniu.php">Comandă</a>
                        </div>
                    </div>

                    <div class="item">
                        <img src="img/slide2.jpg" alt="s2">
                        <div class="carousel-caption">
                            <h3><strong>Livram rapid si sigur.</strong></h3>
                            <p>Cele mai bune specialitați culinare, la un click distanta.</p>
                            <p><a class=" btn btn-lg btn-circle btn-outline-new-white wtp_ab" href="rezerva.php">Rezervă</a>

                                <p><a class=" btn btn-lg btn-circle btn-outline-new-white wtp_ab" href="#">Comandă</a>

                        </div>
                    </div>

                    <div class="item">
                        <img src="img/slide3.jpg" alt="s1">
                        <div class="carousel-caption">
                            <h3><strong>Rezerva o masa acum!</strong></h3>
                            <p>Bucura-te cu noi de atmosfera placuta a restaurantului.</p>
                            <p><a class=" btn btn-lg btn-circle btn-outline-new-white wtp_ab" href="rezerva.php">Rezervă</a>

                                <p><a class=" btn btn-lg btn-circle btn-outline-new-white wtp_ab" href="#">Comandă</a>
                        </div>
                    </div>

                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </center>
        <!--Despre-->
        <div class="about-section-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                        <div class="inner-column">
                            <center>
                                <h1>Despre noi</h1>
                                <p>Restaurantul nostru este alegerea perfecta.</p>
                                <p>Gustul bun, ospitalitatea si simtul estetic ne definesc cel mai bine.</p>
                                <a class="wtp_ab btn btn-lg btn-circle btn-outline-new-white" href="despre.php">Mai Mult</a>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <img src="img/about-img.jpg" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <!--Citat-->
        <div class="citat-box q-background">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <p class="lead ">
                            "Arta cu cei mai mulţi adepţi rămâne totuşi arta culinară."
                        </p>
                        <span class="lead">Valeriu Butulescu.</span>
                    </div>
                </div>
            </div>
        </div>
        <!--Galerie-->
        <div class="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-title text-center">
                            <h2>Galerie</h2>
                            <p>Vezi cele mai apreciate specialitati ale noastre.</p>
                            <p>Pentru a vedea toata galeria, apasa <a class="aa" href="galerie.php">aici</a>.</p>
                        </div>
                        <br>
                    </div>
                    <div class="col-lg-12 col-md-4 col-lg-4">
                        <a href="img/gallery1.jpg" data-lightbox="mygallery" data-title="Meniul Marinarului"><img class="gallery2" src="img/gallery1small.jpg">
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <a href="img/gallery2.jpg" data-lightbox="mygallery" data-title="Somon cu legume"><img class="gallery2" src="img/gallery2small.jpg">
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <a href="img/gallery4.jpg" data-lightbox="mygallery" data-title="Prajitura cu frisca de casa"><img class="gallery2" src="img/gallery4small.jpg">
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <a href="img/gallery5.jpg" data-lightbox="mygallery" data-title="Orez asezonat cu legume"><img src="img/gallery5small.jpg" class="gallery2">
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <a href="img/gallery6.jpg" data-lightbox="mygallery" data-title="Meniu complet"><img src="img/gallery6small.jpg" class="gallery2">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--Footer-->
    <?php include 'includes/footer.php'; ?>



</body>

</html>