<div class="navbar navbar-inverse bg-light" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myidname">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <span class="navbar-brand">Restaurant</span>
    </div>
    <div class="navbar-collapse collapse" id="myidname">
        <form class="navbar-form navbar-right" action="search.php">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Cauta" name="q">
            </div>
            <button type="submit" class="btn btn-default">Cauta</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Acasa</a></li>
            <li><a href="despre.php">Despre</a></li>
            <li><a href="meniu.php">Meniu</a></li>
            <li><a href="rezerva.php">Rezerva</a></li>
            <li><a href="galerie.php">Galerie</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if(!isset($_SESSION['client'])){ ?>
            <li><a style="cursor: pointer; transition: 2s ease;" onclick="openform()" id="log">Logare</a></li>
            
            <?php }else{ ?>
            <li><a href="account.php">Contul Meu</a></li>
            <!--<li><a href="invoice.php">Facturi</a></li>-->
            <li><a href="logout.php">Deconectare</a></li>
            <?php } ?>
        </ul>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)   Order is important -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</div>