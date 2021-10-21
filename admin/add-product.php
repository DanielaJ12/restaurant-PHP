<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}
include '../includes/dbd.inc.php';
if(isset($_POST['name'])){
    $allowed_images = array('png', 'jpg', 'jpeg', 'gif', 'bmp');
    $path_parts = pathinfo($_FILES["image"]["name"]);
    $extension = $path_parts['extension'];
    $tmpFilePath = $_FILES['image']['tmp_name'];
    $extension = strtolower($extension);
    $iname = uniqid(time());
    $image = "$iname.$extension";
    if(in_array($extension, $allowed_images)){
        $stmt = $sql->prepare("INSERT into p_product (name, price, image, description) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $_POST['name'], PDO::PARAM_STR);
        $stmt->bindParam(2, $_POST['price'], PDO::PARAM_STR);
        $stmt->bindParam(3, $image, PDO::PARAM_STR);
        $stmt->bindParam(4, $_POST['description'], PDO::PARAM_STR);
        $stmt->execute();
        $idProduct = $sql->lastInsertId();
        move_uploaded_file($tmpFilePath, "../img/$image");
        
        $stmt = $sql->prepare("INSERT into p_takepartfrom (idCategory, idProduct) VALUES (?, ?)");
        $stmt->bindParam(1, $_POST['category'], PDO::PARAM_STR);
        $stmt->bindParam(2, $idProduct, PDO::PARAM_STR);
        $stmt->execute();
        $msg = "<div class='alert alert-success'>Produsul a fost adăugat cu succes.</div>";
    }else{
        $msg = "<div class='alert alert-danger'>Vă rugăm să adaugați altă poză.</div>";
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

    <title>Adaugă Produs</title>

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
        <?php $tab='products'; $page='add-product'; include 'includes/nav.php'; ?>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Adaugă Produs</h6>
                                </div>

                                <div class="card-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="">Nume Produs</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Preț</label>
                                            <input type="number" class="form-control" name="price" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tip Categorie</label>
                                            <select required name="type" class="form-control" id="type">
                                                <option value="">Alege</option>
                                                <option value="1">Băutură</option>
                                                <option value="2">Mâncare</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Categorie</label>
                                            <select required name="category" class="form-control" id="category">
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Imagine</label>
                                            <input type="file" class="form-control" name="image" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Descriere</label>
                                            <textarea class="form-control" name="description" id="" cols="30" rows="5"></textarea>
                                        </div>
                                        <button class="btn btn-primary btn-block">Adaugă</button>
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
    <script>
        
        
        <?php 
            $drinks = "";
            $stmt = $sql->prepare("Select * from p_category where idType=1");
            $stmt->execute();
            $categories = $stmt->fetchAll();
            foreach($categories as $category){
                $drinks.='<option value="'.$category['idCategory'].'">'.$category['name'].'</option>';
            }
        ?>
        
        <?php 
            $foods = "";
            $stmt = $sql->prepare("Select * from p_category where idType=2");
            $stmt->execute();
            $categories = $stmt->fetchAll();
            foreach($categories as $category){
                $foods.='<option value="'.$category['idCategory'].'">'.$category['name'].'</option>';
            }
        ?>
        
        var drinks = '<?php echo $drinks; ?>';
        var foods = '<?php echo $foods; ?>';
        
        $("#type").change(function(){
           var val = $(this).val();
           if(val==1){
               $("#category").html(drinks);
           }else{
               $("#category").html(foods);
           }
        });
    </script>

</body>

</html>