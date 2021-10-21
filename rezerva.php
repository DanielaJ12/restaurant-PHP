<?php
session_start();
include 'includes/dbd.inc.php';
?>
<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
<title>Restaurant</title>
<?php include 'includes/head.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">

<style>
    h3{
        color: white;
    }    
    .form-control{
        color: white;
    }
</style>
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

					<h1><hr>Rezerv&#259<hr></h1>
				</div>
			</div>
		</div>
    </div>
	<!-- Start Reservation -->
	<div class="reservation-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Rezervare</h2><br>
						<p>Restaurantul nostru iti ofera va oferi o atmosfera inedita. Conevinge-te singur, rezerva o masa!</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3 col-sm-12 col-xs-12">
					<div class="contact-block">
					<?php if(isset($_SESSION['client'])){ ?>
						<form method="post" action="reserve-table.php">
							<div class="row">
								<div class="col-md-12"><br>
									<h3>Rezerv&#259 o mas&#259</h3>
                                   
                                   <br>
                                    
									<div class="col-md-12">
										<div class="form-group">
											<input required id="datetimepicker" class="form-control" name="date" type="text" placeholder="Alegeți data rezervării">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<select required name="time" class="form-control" id="">
											    <option value="">Alegeți ora</option>
											    <option value="13:00">01:00 pm</option>
											    <option value="14:00">02:00 pm</option>
											    <option value="15:00">03:00 pm</option>
											    <option value="16:00">04:00 pm</option>
											    <option value="17:00">05:00 pm</option>
											    <option value="18:00">06:00 pm</option>
											    <option value="19:00">07:00 pm</option>
											    <option value="20:00">08:00 pm</option>
											    <option value="21:00">09:00 pm</option>
											    <option value="22:00">10:00 pm</option>
											</select>
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<select required class="custom-select d-block form-control" id="person" required data-error="Please select Person" name="table">
											  <option value="" selected>Selectați masa*</option>
											  <?php
                                                $query = "select * from p_table";
                                                $stmt = $sql->prepare($query);
                                                $stmt->execute();
                                                $tables = $stmt->fetchAll();
                                                foreach($tables as $table){
                                              ?>
                                              <option value="<?php echo $table['idTable']; ?>"><?php echo $table['pozition']; ?> (Pentru <?php echo $table['nrPeople']; ?> persoane)</option>
                                              <?php } ?>
											</select>
											<div class="help-block with-errors"></div>
										</div> 
									</div>
								</div>

								<div class="col-md-12">
									<div class="submit-button text-center">
										<button class="btn btn-common" id="submit" type="submit">Rezerv&#258</button>
										<div id="msgSubmit" class="h3 text-center hidden"></div> 
										<div class="clearfix"></div> <br>
									</div>
								</div>
							</div>            
						</form>
				    <?php }else{ ?>
				  
				    <center>
				        <button onclick="openform()" class="btn btn-warning">Logați-vă pentru rezerva o masă</button>
				    </center>
				    <br><br>
				    <?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Reservation -->

    <!--Footer-->
    <?php include 'includes/footer.php'; ?>
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
         $(function () {
             $('#datetimepicker').datetimepicker({
                 format: 'YYYY-MM-DD',
				 minDate:new Date()
             });
         });
        
        $(function () {
             $('#timepicker').datetimepicker({
                 format: 'HH:mm',
             });
         });
      </script>

</body>
</html> 

		
