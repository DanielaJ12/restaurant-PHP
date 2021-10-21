<?php
session_start();
include '../includes/dbd.inc.php';




if(!isset($_SESSION['admin'])){
    header("location:login.php");
}

if(isset($_POST['submit'])){
    $stmt = $sql->prepare("INSERT into p_category (name, idType) VALUES (?, ?)");
    $stmt->bindParam(1, $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_POST['idType'], PDO::PARAM_STR);
    $stmt->execute();
    $msg1 = "<div class='alert alert-success'>Categoria a fost adăugată cu succes.</div>";
}
if(isset($_POST['update'])){
    $stmt = $sql->prepare("Update p_category set name=?, idType=? where idCategory=?");
    $stmt->bindParam(1, $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_POST['idType'], PDO::PARAM_STR);
    $stmt->bindParam(3, $_POST['category_id'], PDO::PARAM_STR);
    $stmt->execute();
    $msg1 = "<div class='alert alert-success'>Categoria a fost modificată cu succes.</div>";
}
if(isset($_POST['delete'])){
	
	$catid=$_POST['catid'];
	
	


	
	$check="SELECT * FROM `p_takepartfrom` WHERE `idCategory`=$catid ";
 
 $result=$sql->query($check);
 
 
 
 
 if ($result->rowCount()>0)
	{
//here we will add the delete with message warning
	 
	header("Location:confirm_delete.php?catid=$catid");
	exit();
	
	 
	}
	else
	{
		
	// directly delete
	
	
	$stmt = $sql->prepare("
	DELETE from p_category where idCategory=?");
    $stmt->bindParam(1, $_POST['catid'], PDO::PARAM_STR);
    $stmt->execute();
    $msg1 = "<div class='alert alert-success'>Categoria a fost ștearsă.</div>";
	
	}
	
    
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

    <title>Categorii</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $tab=''; $page='c-categories'; include 'includes/nav.php'; ?>
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
                        <h1 class="h3 mb-0 text-gray-800">Categorii</h1>
                        
                    </div>

                    <!-- Content Row -->


                    <!-- Content Row -->


                </div>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Categorii
                            <span class="float-right">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Adaugă Categorie</button>
                            </span>
                            </h6>
                        </div>
                        <div class="card-body">
						
						<?php require_once'errorreporting.php';?>
							
                           <?php if(isset($msg1)){ echo $msg1; } ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nume</th>
                                             <th>Tip</th>
                                            <th>Acțiuni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										
									
										   
                                            $stmt = $sql->prepare("
											Select * FROM `p_category` ORDER BY idCategory DESC
											
									
											");
                                            $stmt->execute();
                                            $categories =  $stmt->fetchAll();
                                            foreach($categories as $category){
												
                                        ?>
                                        <tr>
                                            <td width="50%"><?php echo $category['name']; ?></td>
                                            <td width="50%">
                                                <?php if($category['idType']==1){ echo 'Bauturi'; }else{ echo 'Mancaruri'; } ?>
                                            </td>
                                            <td>
                                                
												
												
												
<form method="post" action="">												
						
<input type="hidden" value="<?php echo $category['idCategory']; ?>" name="catid">


<a class="edit" data-idType="<?php echo $category['idType']; ?>" data-id="<?php echo $category['idCategory']; ?>" data-name="<?php echo $category['name']; ?>" href="#!"><i class="fa fa-edit"></i></a>
                                                
												
<button type="submit" value="delete" name="delete" ><i class="fa fa-trash"></i></button>
                   
				   
</form>											
											
											</td>
                                        </tr>
                                        <?php } ?>
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
                        <span>Copyright &copy; Restaurant 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificați Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nume Categorie</label>
                            <input type="text" class="form-control" name="name" required id="editname">
                        </div>
                        <div class="form-group">
                            <label for="">Selectați Tipul Categoriei</label>
                            <select required name="idType" class="form-control" id="editidtype">
                                <option value="">Alegeți</option>
                                <option value="1">Băuturi</option>
                                <option value="2">Mâncăruri</option>
                            </select>
                            <input type="hidden" name="category_id" id="editid">
                        </div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Închideți</button>
                        <button name="update" type="submit" class="btn btn-primary">Modificați</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adăugați Categorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div class="form-group">
                           <label for="">Nume</label>
                           <input type="text" class="form-control" name="name" required>
                       </div>
                       <div class="form-group">
                            <label for="">Selectați Tipul Categoriei</label>
                            <select required name="idType" class="form-control">
                                <option value="">Alegeți</option>
                                <option value="1">Băuturi</option>
                                <option value="2">Mâncăruri</option>
                            </select>
                        </div>
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Închideți</button>
                       <button name="submit" type="submit" class="btn btn-primary">Adăugați</button>
                    </div>
                </div>
            </form>
        </div>
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

    <!-- Modal functions to delete categories and edit-->
    <script>
    
        
    $(".edit").click(function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        var type = $(this).data('idtype');
        $("#editid").val(id);
        $("#editname").val(name);
        $("#editidtype").val(type);
        $("#editModal").modal("show");
    })
    </script>

</body>

</html>