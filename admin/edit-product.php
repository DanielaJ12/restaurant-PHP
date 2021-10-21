<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}
include '../includes/dbd.inc.php';
$stmt = $sql->prepare("select * from p_product where idProduct=?");
$stmt->bindParam(1, $_GET['id']);
$stmt->execute();
$productdata =  $stmt->fetch();

if(isset($_POST['name'])){
    $stmt = $sql->prepare("Update p_product set name=?, price=?, description=? where idProduct=?");
    $stmt->bindParam(1, $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_POST['price'], PDO::PARAM_STR);
    $stmt->bindParam(3, $_POST['description'], PDO::PARAM_STR);
    $stmt->bindParam(4, $_GET['id'], PDO::PARAM_STR);
    $stmt->execute();
    $stmt = $sql->prepare("select * from p_product where idProduct=?");
    $stmt->bindParam(1, $_GET['id']);
    $stmt->execute();
    $productdata =  $stmt->fetch();
    $msg = "<div class='alert alert-success'>Produsul a fost modificat cu succes.</div>";
}

if(isset($_POST['updateImage'])){
    $allowed_images = array('png', 'jpg', 'jpeg', 'gif', 'bmp');
    $path_parts = pathinfo($_FILES["image"]["name"]);
    $extension = $path_parts['extension'];
    $tmpFilePath = $_FILES['image']['tmp_name'];
    $extension = strtolower($extension);
    $iname = uniqid(time());
    $image = "$iname.$extension";
    $tmpFilePath = $_FILES['image']['tmp_name'];
    $extension = strtolower($extension);
    if(in_array($extension, $allowed_images)){
		$stmt = $sql->prepare("Update p_product set image=? where idProduct=?");
		$stmt->bindParam(1, $image, PDO::PARAM_STR);
		$stmt->bindParam(2, $_GET['id'], PDO::PARAM_STR);
		$stmt->execute();
        move_uploaded_file($tmpFilePath, "../img/".$image);
		$productdata['image'] = $image;
        $msg = "<div class='alert alert-success'>Imaginea a fost modificată cu succes.</div>";
    }else{
        $msg = "<div class='alert alert-danger'>Vă rugăm să selectați poză cu extensie de tip jpg, png, jpeg, gif sau bmp.</div>";
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

    <title>Edit Product</title>

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
        <?php include 'includes/nav.php'; ?>
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
                        <h1 class="h3 mb-0 text-gray-800">Produse</h1>
                        
                    </div>

                    <!-- Content Row -->


                    <!-- Content Row -->


                </div>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-md-8">
                           <?php if(isset($msg)){ echo $msg; } ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Modifică Produs <a href="products.php" class="btn btn-primary btn-sm float-right">Înapoi</a></h6>
                                    
                                </div>

                                <div class="card-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="">Nume Produs</label>
                                            <input type="text" class="form-control" name="name" required value="<?php echo $productdata['name']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Preț Produs</label>
                                            <input type="number" class="form-control" name="price" required value="<?php echo $productdata['price']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Descriere</label>
                                            <textarea class="form-control" name="description" id="" cols="30" rows="5"><?php echo $productdata['description']; ?></textarea>
                                        </div>
                                        <button class="btn btn-primary btn-block">Modifică</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <img width="100%" height="250" style="object-fit:contain" src="../img/<?php echo $productdata['image'].'?'.time(); ?>" alt="" class="img-thumbnail mb-4">
                                    
                                    <form action="" method="post" enctype="multipart/form-data" id="updateform">
                                        <label for="">Actualizează poza</label>
                                        <input type="file" class="form-control" name="image" onchange="$('#updateform').submit();">
                                        <input type="hidden" name="updateImage">
                                    </form>
                                    
                                </div>
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
    <!-- End of Page Wrapper -->
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
    

</body>

</html>