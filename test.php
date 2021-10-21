<?php
session_start();
include 'includes/dbd.inc.php';
?>
<html>
	<head>
		<title>Invoice generator</title>
	</head>
	<body>
		select invoice:
		<form method='get' action='invoice-db.php'>
			<select name='invoiceID'>
				<?php
					//show invoices list as options
					$query = mysqli_query($con,"select * from p_invoice");
					while($invoice = mysqli_fetch_array($query)){
						echo "<option value='".$invoice['nrInvoice']."'>".$invoice['nrInvoice']."</option>";
					}
				?>
			</select>
			<input type='submit' value='Generate'>
		</form>
	</body>
</html>
