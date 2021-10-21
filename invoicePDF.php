<?php
require('C:\xampp\htdocs\SERVER\restaurant\fpdf183\fpdf.php');
session_start();

$nrInvoice=$_GET['nrinvoice'];
/*$series=$_GET['series'];
$date=$_GET['date'];*/

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'rest');

$query = mysqli_query($con, "SELECT *FROM p_invoice INNER JOIN p_order using (idOrder) WHERE p_invoice.nrInvoice='$nrInvoice'");
$invoice = mysqli_fetch_array($query);

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',20);

/*Cell(width , height , text , border , end line , [align] )*/

$pdf->Cell(71 ,10,'',0,0);
$pdf->Cell(59 ,5,'Factura',0,0);
$pdf->Cell(59 ,10,'',0,1);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(71 ,5,'Furnizor',0,0);
$pdf->Cell(59 ,5,'',0,0);
$pdf->Cell(59 ,5,'Detalii',0,1);

$pdf->SetFont('Arial','',10);

$pdf->Cell(130 ,5,'Restaurant Galati',0,0);
$pdf->Cell(25 ,5,'ID Client:',0,0);
$pdf->Cell(34 ,5,'0012',0,1);

/*$pdf->Cell(130 ,5,'CIF:16745991',0,0);
$pdf->Cell(25 ,5,'Emis la data:',0,0);
$pdf->Cell(34 ,5,$date,0,1);*/
 
$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Numar factura:',0,0);
$pdf->Cell(34 ,5,$nrInvoice,0,1);

/*$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Serie:',0,0);
$pdf->Cell(34 ,5,$series,0,1);*/


$pdf->Cell(50 ,10,'',0,1);

$pdf->SetFont('Arial','B',10);
/*Heading Of the table*/
$pdf->Cell(10 ,6,'Sl',1,0,'C');
$pdf->Cell(80 ,6,'Description',1,0,'C');
$pdf->Cell(23 ,6,'Qty',1,0,'C');
$pdf->Cell(30 ,6,'Unit Price',1,0,'C');
$pdf->Cell(20 ,6,'Sales Tax',1,0,'C');
$pdf->Cell(25 ,6,'Total',1,1,'C');/*end of line*/
/*Heading Of the table end*/
$pdf->SetFont('Arial','',10);
    for ($i = 0; $i <= 10; $i++) {
		$pdf->Cell(10 ,6,$i,1,0);
		$pdf->Cell(80 ,6,'HP Laptop',1,0);
		$pdf->Cell(23 ,6,'1',1,0,'R');
		$pdf->Cell(30 ,6,'15000.00',1,0,'R');
		$pdf->Cell(20 ,6,'100.00',1,0,'R');
		$pdf->Cell(25 ,6,'15100.00',1,1,'R');
	}
		

$pdf->Cell(118 ,6,'',0,0);
$pdf->Cell(25 ,6,'Subtotal',0,0);
$pdf->Cell(45 ,6,'151000.00',1,1,'R');


$pdf->Output();

?>
      