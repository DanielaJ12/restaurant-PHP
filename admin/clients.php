<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}

$servername="localhost";
$username="root";
$password="";
$dbname="rest";
try
{
$conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
$count=$conn->prepare("SELECT COUNT(idClient) AS num FROM `p_client`");
$count->execute();
$row=$count->fetch(PDO::FETCH_ASSOC);

$totalrowcount=$row['num'];

}
catch(PDOEXCEPTION $e)
{
	echo"error connecting".$e->getMessage();
}
$error=$user=$order=$booking="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$switchraw=$_POST['switch'];
	
	
	if($switchraw=="booking_accepted")
	{
	$booking="accepted";	
		
	}
	elseif($switchraw=="booking_pending")
	{
        $booking="pending";	
	}
    
    elseif($switchraw=="order_delivered")
	{
        $order="delivered";
	}
    elseif($switchraw=="order_pending")
	{
        $order="pending";
	}
    elseif($switchraw=="active_user")
    {
	$user="active";
	}
    elseif($switchraw=="inactive_user")
    {
	$user="inactive";
	}
    else
    {
        $error="1";
    }
	
    
}
else
{
	$error="2";
    		
}

//switch logic ends



include '../includes/dbd.inc.php';
if(isset($_POST['delete'])){
	
	$stmt = $sql->prepare("Delete from p_user where idClient=?");
    $stmt->bindParam(1, $_POST['id']);
    $stmt->execute();
   	
	$stmt = $sql->prepare("Delete from p_client where idClient=?");
    $stmt->bindParam(1, $_POST['id']);
    $stmt->execute();
    $msg = '<div class="alert alert-success">Clientul a fost șters cu succes!</div>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clients</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $tab=''; $page='users'; include 'includes/nav.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'includes/header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Clienți</h1>
                        
                    </div>

                    <!-- Content Row -->


                    <!-- Content Row -->


                </div>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listă Clienți</h6>
                        </div>
                        <div class="card-body">
						
						<div style="padding:10px;">
						<form class="form-inline " method="post" action="">
						<div class="form-group mx-sm-3 mb-2">
                        
						<select class="form-control" id="switch" name="switch" required>
							<option value="" >Clienți</option>
							<option value="booking_accepted">Rezervări acceptate</option>
							<option value="booking_pending">Rezervări în așteptare</option>
                            <option value="order_delivered">Comenzi livrate</option>
							<option value="order_pending">Comenzi în așteptare</option>
                            <option value="active_user">Activi</option>
                            <option value="inactive_user">Inactivi</option>
							
						</select>
                        
							</div>

							<button type="submit" class="btn btn-primary " >Afișează</button>
							</form>
							</div>
						
                           <?php if(isset($msg)){ echo $msg; } ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nume</th>
                                            <th>Prenume</th>
                                            <th>Email</th>
                                            <th>Telefon</th>
                                            <th>Adresă</th>
                                            <th>User</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										
										if ($error=="2")

											{
												$stmt = $sql->prepare(

"SELECT * FROM `p_client` WHERE `user`!='admin'");

										}
											elseif($error=="1")
											{
										
                                                
                                                $stmt = $sql->prepare(			

"SELECT * FROM `p_client` WHERE `user`!='admin'");

                                            }
                                            else
                                            {


if($booking=="accepted")
{

    
    $stmt = $sql->prepare(			

        "SELECT 
        `p_client`.`name`,
        `p_client`.`surname`,
        `p_client`.`email`,
        `p_client`.`phone`,
        `p_client`.`address`,
        `p_client`.`user`,
        `p_booking`.`idClient`,
        `p_booking`.`status`
         FROM `p_client` 
         INNER JOIN `p_booking` ON
         `p_client`.`idClient`=`p_booking`.`idClient`
         WHERE `p_booking`.`status`='accepted' AND `p_client`.`user`!='admin'    ORDER BY `idClient` DESC "
         );
    

}
elseif($booking=="pending")
{
    $stmt = $sql->prepare(			

        "SELECT 
        `p_client`.`name`,
        `p_client`.`surname`,
        `p_client`.`email`,
        `p_client`.`phone`,
        `p_client`.`address`,
        `p_client`.`user`,
        `p_booking`.`idClient`,
        `p_booking`.`status`
         FROM `p_client` 
         INNER JOIN `p_booking` ON
         `p_client`.`idClient`=`p_booking`.`idClient`
         WHERE `p_booking`.`status`='pending' AND `p_client`.`user`!='admin'    ORDER BY `idClient` DESC ");
}
elseif($order=="delivered")
{
    $stmt = $sql->prepare(			

        "SELECT 
        `p_client`.`name`,
        `p_client`.`surname`,
        `p_client`.`email`,
        `p_client`.`phone`,
        `p_client`.`address`,
        `p_client`.`user`,
        `p_order`.`idClient`,
        `p_order`.`status`
         FROM `p_client` 
         INNER JOIN `p_order` ON
         `p_client`.`idClient`=`p_order`.`idClient`
         WHERE `p_order`.`status`='delivered' AND `p_client`.`user`!='admin'    ORDER BY `idClient` DESC  ");
}
elseif($order=="pending")
{
    $stmt = $sql->prepare(			

        "SELECT 
        `p_client`.`name`,
        `p_client`.`surname`,
        `p_client`.`email`,
        `p_client`.`phone`,
        `p_client`.`address`,
        `p_client`.`user`,
        `p_order`.`idClient`,
        `p_order`.`status`
         FROM `p_client` 
         INNER JOIN `p_order` ON
         `p_client`.`idClient`=`p_order`.`idClient`
         WHERE `p_order`.`status`='pending' AND `p_client`.`user`!='admin' ORDER BY `idClient` DESC");  
}
elseif($user=="active")
{
    $stmt = $sql->prepare(			

        "SELECT * FROM `p_client` WHERE EXISTS (SELECT `idClient` FROM `p_booking` WHERE `p_client`.`idClient`=`p_booking`.`idClient` ) AND `user`!='admin'
        UNION
        
         SELECT * FROM `p_client` WHERE EXISTS (SELECT `idClient` FROM `p_order` WHERE `p_client`.`idClient`=`p_order`.`idClient` )AND `user`!='admin'
         ORDER BY `idClient` DESC
         ;"
         
   
        ); 
 
}
elseif($user=="inactive")
{
    $stmt = $sql->prepare(			

        "SELECT * FROM `p_client` WHERE `p_client`.`idClient`
        NOT IN
        (SELECT `p_booking`.`idClient` FROM `p_booking` 
        UNION 
        SELECT `p_order`.`idClient` FROM `p_order`)
        HAVING `p_client`.`user`!='admin';  "
       
    
    );  
}
else
{
    $stmt = $sql->prepare(			

        "SELECT `` FROM `p_client` WHERE `user`!='admin'");  
}

                                            }
                                                				
                                            $stmt->execute();
                                            $clients =  $stmt->fetchAll();
                                            foreach($clients as $client){
                                        ?>
                                        <tr>
                                            
                                            <td><?php echo $client['name']; ?></td>
                                            <td><?php echo $client['surname']; ?></td>
                                            <td><?php echo $client['email']; ?></td>
                                            <td><?php echo $client['phone']; ?></td>
                                            <td><?php echo $client['address']; ?></td>
                                            <td><?php echo $client['user']; ?></td>
                                            
                                        </tr>
											<?php }
											?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <form action="" method="post" id="deleteForm">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="delete" value="1">
    </form>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script>
    $(".delete").click(function(){
        var id = $(this).data('id');
        $("#id").val(id);
        if(confirm('Sunteți sigur/ă ca doriți să ștergeți clientul dat?')){
            $("#deleteForm").submit();
        }
    })
    </script>

</body>

</html>