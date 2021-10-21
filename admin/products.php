<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}
include '../includes/dbd.inc.php';
if(isset($_POST['delete'])){
    $stmt = $sql->prepare("Delete from p_product where idProduct=?");
    $stmt->bindParam(1, $_POST['id']);
    $stmt->execute();
    
    $stmt = $sql->prepare("Delete from p_takepartfrom where idProduct=?");
    $stmt->bindParam(1, $_POST['id']);
    $stmt->execute();
    
    $msg = '<div class="alert alert-success">Produsul a fost șters cu succes!</div>';
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

    <title>Products</title>

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
        <?php $tab='products'; $page='products'; include 'includes/nav.php'; ?>
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
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Toate Produsele</h6>
                        </div>
                        <div class="card-body">
                           <?php if(isset($msg)){ echo $msg; } ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Imagine</th>
                                            <th>Nume</th>
                                            <th>Preț</th>
                                            <th>Categorie</th>
                                            <th>Tip Categorie</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            $stmt = $sql->prepare("select b.*, c.name as category_name, c.idType from p_takepartfrom as a left join p_product as b on a.idProduct=b.idProduct left join p_category as c on a.idCategory=c.idCategory order by b.name asc");
                                            $stmt->execute();
                                            $products =  $stmt->fetchAll();
                                            foreach($products as $product){
                                        ?>
                                        <tr>
                                            <td width="10%">
                                                <img class="img-thumbnail" width="50" height="50" src="../img/<?php echo $product['image']; ?>" alt="">
                                            </td>
                                            <td><?php echo $product['name']; ?></td>
                                            <td><?php echo $product['price']; ?> Lei</td>
                                            <td><?php echo $product['category_name']; ?></td>
                                            <td>
                                                <?php if($product['idType']==1){ echo 'Bauturi'; }else{ echo 'Mancaruri'; } ?>
                                            </td>
                                            <td>
                                                <a href="edit-product.php?id=<?php echo $product['idProduct']; ?>"><i class="fa fa-edit"></i></a>
                                                <a class="delete" data-id="<?php echo $product['idProduct']; ?>" href="#!" style="color:red"><i class="fa fa-trash"></i></a>
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
        if(confirm('Sunteți sigur/ă că doriți să ștergeți produsul??')){
            $("#deleteForm").submit();
        }
    })
    </script>

</body>

</html>