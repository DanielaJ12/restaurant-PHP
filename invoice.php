
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
.table-responsive th {
  padding-top: 12px;
  padding-bottom: 12px;
  background-color: sandybrown;
  text-align: center;
  text-transform: uppercase;
  color: white;
}
.table-responsive button{
    width: 50%;
    font-weight: 600;
	text-align: center;
	white-space: nowrap;
	border: 2px solid transparent;
	letter-spacing: 1px;
	text-transform: uppercase;
    color: sandybrown;
	background-color: transparent;
	background-image: none;
	border-color: sandybrown;
	border-radius: .1875rem;
}
.table-responsive button:hover{
	color: #ffffff;
	background-color: #333333;
	border-color: #333333;
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
	
	<!-- Start Reservation -->
	<div class="reservation-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Facturile mele</h2><br>
                        <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Numar Factura</th>
                                            <th>Serie</th>
                                            <th>Data</th>
                                            <th>Total</th>
                                            <th>PDF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php  
                                            $stmt = $sql->prepare("Select p_invoice.nrInvoice, p_invoice.series, p_invoice.date, p_order.payment FROM p_invoice join p_order ON p_invoice.idOrder=p_order.idOrder");  
                                            $stmt->execute();
                                            $invoices = $stmt->fetchAll();
                                            foreach($invoices as $invoice){
                                             
                                    ?>
                                    <td><?php echo $invoice['nrInvoice']; ?></td>
                                    <td><?php echo $invoice['series']; ?></td>
                                    <td><?php echo $invoice['date']; ?></td>
                                    <td><?php echo $invoice['payment']; ?></td>
                                    <td><button onclick="parent.location='invoicePDF.php?nrinvoice=<?php echo $invoice['nrInvoice']; ?>'">Vezi PDF</button></td>
                                    </tbody>

                                    <?php } ?>
						<table>
                        </div>
                        </div>
                    </div>

                </div>






	<!-- End Reservation -->

    <!--Footer-->
 


</body>
</html> 

		
