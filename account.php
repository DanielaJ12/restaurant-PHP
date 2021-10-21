<?php
session_start();
if(!isset($_SESSION['client'])){
    header("location:index.php");
}
include 'includes/dbd.inc.php';

if(isset($_POST['submit'])){
    $stmt = $sql->prepare("select * from p_client where email=? AND idClient!=?");
    $stmt->bindParam(1, $_POST['email'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_SESSION['clientId'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if($stmt->rowCount()>0){
        $msg = "<div class='alert alert-danger'>Există deja un utilizator cu acest email.</div>";
    }else{
        $stmt = $sql->prepare("select * from p_client where user=? AND idClient!=?");
        $stmt->bindParam(1, $_POST['user'], PDO::PARAM_STR);
        $stmt->bindParam(2, $_SESSION['clientId'], PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        if($stmt->rowCount()>0){
            $msg = "<div class='alert alert-danger'>Acest utilizator există deja în baza de date.</div>";
        }else{
            $query = "UPDATE p_client set name=?, surname=?, phone=?, email=?, address=?, user=? where idClient=?";
            $stmt = $sql->prepare($query);
            $stmt->bindParam(1, $_POST['name'], PDO::PARAM_STR);
            $stmt->bindParam(2, $_POST['surname'], PDO::PARAM_STR);
            $stmt->bindParam(3, $_POST['phone'], PDO::PARAM_STR);
            $stmt->bindParam(4, $_POST['email'], PDO::PARAM_STR);
            $stmt->bindParam(5, $_POST['address'], PDO::PARAM_STR);
            $stmt->bindParam(6, $_POST['user'], PDO::PARAM_STR);
            $stmt->bindParam(7, $_SESSION['clientId'], PDO::PARAM_INT);
            $stmt->execute();
            
            $query = "UPDATE p_user set user=? where idClient=?";
            $stmt = $sql->prepare($query);
            $stmt->bindParam(1, $_POST['user'], PDO::PARAM_STR);
            $stmt->bindParam(2, $_SESSION['clientId'], PDO::PARAM_INT);
			$msg = "<div class='alert alert-success'>Actualizarile au fost efectuate cu succes.</div>";
			$stmt->execute();
        }
    }
}


// profile ends

//password reset/update starts

if(isset($_POST['submitpassword']))
{
    if($_POST['newpassword']==$_POST['confirm_password'])
	
	{
		$password = $_POST['oldpassword'];
		$client_id=$_SESSION['clientId'];
		$newpassword=$_POST['newpassword'];


		$sql1="SELECT * FROM `p_user` WHERE `idClient`=$client_id";
		$result1=$sql->query($sql1);
		if($result1->rowCount()>0)
		{
				while($row=$result1->fetch(PDO::FETCH_ASSOC))
				{
					$oldpassword=$row['password'];
							if($password==$oldpassword)

							{
								$query = "UPDATE `p_user` SET `password`=? where `idClient`=?";
								$stmt = $sql->prepare($query);
								$stmt->bindParam(1, $newpassword, PDO::PARAM_STR);
								$stmt->bindParam(2, $client_id, PDO::PARAM_INT);
								$stmt->execute();
								$msg = "<div class='alert alert-success'>Parolă modificată cu succes.</div>";
							}
							else
							{
								$msg = "<div class='alert alert-danger'>Vechea parola este incorectă.</div>";
							}
						
				}


		}
		else 
		{
		$msg = "<div class='alert alert-danger'>User incorect.</div>";	
		}

			
	}
	else 
	{
		$msg = "<div class='alert alert-danger'>Parolele nu coincid.</div>";	
	}

        
}


//password update ends

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
	
	<!-- Start Reservation -->
	<div class="reservation-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Contul meu</h2><br>
						<p>Modifcă datele</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3 col-sm-12 col-xs-12">
				    <?php if(isset($msg)){ echo $msg; } ?>
					<div class="contact-block">
					    <?php
                            $query = "select * from p_client where idClient=?";
                            $stmt = $sql->prepare($query);
                            $stmt->bindParam(1, $_SESSION['clientId']);
                            $stmt->execute();
                            $user = $stmt->fetch();
                        ?>
						<form method="post" action="">
							<div class="row">
								    
									<div class="col-md-12">
										<div class="form-group">
											<input required class="form-control" name="name" type="text" placeholder="Nume" value="<?php echo $user['name']; ?>">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input required class="form-control" name="surname" type="text" placeholder="Prenume" value="<?php echo $user['surname']; ?>">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input required class="form-control" name="email" type="email" placeholder="Email" value="<?php echo $user['email']; ?>">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input required class="form-control" name="phone" type="text" placeholder="Telefon" value="<?php echo $user['phone']; ?>">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input required class="form-control" name="address" type="text" placeholder="Adresa" value="<?php echo $user['address']; ?>">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input required class="form-control" name="user" type="text" placeholder="User" value="<?php echo $user['user']; ?>">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>

								<div class="col-md-12">
									<div class="submit-button text-center">
										<button class="btn btn-common" id="submit" type="submit" name="submit">Actualizează</button>
										<div id="msgSubmit" class="h3 text-center hidden"></div> 
										<div class="clearfix"></div> <br>
									</div>
								</div>
							</div>            
						</form>
                        <br>
                        <center>
                            <h3>Modifică parola</h3>
                        </center>
                        <br>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
							<div class="row">
								    
							<div class="col-md-12">
										<div class="form-group">
											<input required class="form-control" name="oldpassword" type="password" placeholder="Parola veche...">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<input required class="form-control" name="newpassword" type="password" placeholder="Parola nouă...">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input required class="form-control" name="confirm_password" type="password" placeholder="Confirmă noua parola...">
											<div class="help-block with-errors"></div>
										</div>                                 
									</div>
									
									

								<div class="col-md-12">
									<div class="submit-button text-center">
										<button class="btn btn-common" id="submit" type="submit" name="submitpassword">Actualizează</button>
										<div id="msgSubmit" class="h3 text-center hidden"></div> 
										<div class="clearfix"></div> <br>
									</div>
								</div>
							</div>            
						</form>
				    
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
             $('#datepicker').datetimepicker({
                 format: 'YYYY-MM-DD'
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

		
