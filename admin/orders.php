<?php
session_start();
include '../includes/dbd.inc.php';
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}


if(isset($_POST['deliverOrder'])){
    $stmt = $sql->prepare("update p_order set status='delivered' where idOrder=?");
    $stmt->bindParam(1, $_POST['order_id'], PDO::PARAM_INT);
    $stmt->execute();
    $msg = '<div class="alert alert-success">Comanda a fost livrată!</div>';
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

    <title>Comenzi</title>

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
        <?php $tab=''; $page='orders'; include 'includes/nav.php'; ?>
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
                        <h1 class="h3 mb-0 text-gray-800">Comenzi</h1>
                        
                    </div>

                    <!-- Content Row -->


                    <!-- Content Row -->


                </div>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista Comenzi</h6>
                        </div>
                        <div class="card-body">
                           <?php if(isset($msg)){ echo $msg; } ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id-ul Comanzii</th>
                                            <th>Client</th>
                                            <th>Data Plasării</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $stmt = $sql->prepare("Select a.*, b.name, b.surname from p_order as a left join p_client as b on a.idClient=b.idClient order by a.idOrder desc");
                                            $stmt->execute();
                                            $orders =  $stmt->fetchAll();
                                            foreach($orders as $order){
                                        ?>
                                        <tr>
                                            <td><?php echo $order['idOrder']; ?> (<a href="order-details.php?id=<?php echo $order['idOrder']; ?>">Detalii</a>)</td>
                                            <td><?php echo $order['name'].' '.$order['surname']; ?></td>
                                            <td><?php echo $order['dateOrder']; ?>  <?php echo $order['timeOrder']; ?></td>
                                            <td><?php echo $order['payment']; ?> Lei</td>
                                            
                                            <td>
                                            <?php if($order['status']=='pending'){ ?>
                                                <button class="btn btn-warning btn-sm">În curs de livrare</button>
                                            <?php }else{ ?>
                                                <button class="btn btn-success btn-sm">Livrat</button>
                                            <?php } ?>
                                            </td>
                                            <td>
                                                <?php if($order['status']!='delivered'){ ?>
                                                <form action="" method="post" onsubmit="return confirm('Sunteți sigur/ă că doriți șă marcați comanda livrtă?')">
                                                     <input type="hidden" name="order_id" value="<?php echo $order['idOrder']; ?>">
                                                     <button class="btn btn-success btn-sm" name="deliverOrder">Livrează comanda</button>
                                                </form>
                                                
                                                <?php } ?>
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