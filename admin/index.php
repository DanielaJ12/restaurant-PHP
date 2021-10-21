<?php
session_start();
include '../includes/dbd.inc.php';
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}

$stmt = $sql->prepare("select * from p_product");
$stmt->execute();
$products = $stmt->rowCount();



$stmt = $sql->prepare("select * from p_order where status='pending'");
$stmt->execute();
$ordersPending = $stmt->rowCount();

$stmt = $sql->prepare("select * from p_order where status='delivered'");
$stmt->execute();
$ordersDelivered = $stmt->rowCount();

$stmt = $sql->prepare("select * from p_client");
$stmt->execute();
$clients = $stmt->rowCount();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

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
        <?php $tab=''; $page='dashboard'; include 'includes/nav.php'; ?>
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Total Users signed up Start -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Comenzi în așteptare</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $ordersPending; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-800"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- Total Users signed up End -->
                         
                        <!-- Total Orders made Start -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Comenzi Livrate</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $ordersDelivered; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-800"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total Orders made End -->

                        <!-- Total Products in Inventory Start -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Produse</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $products; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-boxes fa-2x text-gray-800"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total Products in Inventory Start -->

                        <!-- Total Courses in Inventory Start -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Clienți</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $clients; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fab fa-leanpub fa-2x text-gray-800"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Total Courses in Inventory End -->
                     
                    <!-- Content Row -->


                </div>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ultimile 10 comenzi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id-ul Comenzii</th>
                                            <th>Client</th>
                                            <th>Data Plasării</th>
                                            <th>Total</th>
                                            <th>Adresa de livrare</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $stmt = $sql->prepare("Select a.*, b.name, b.surname from p_order as a left join p_client as b on a.IdClient=b.idClient order by a.idOrder desc LIMIT 10");
                                            $stmt->execute();
                                            $orders =  $stmt->fetchAll();
                                            foreach($orders as $order){
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?> (<a href="order-details.php?id=<?php echo $order['idOrder']; ?>">Detalii</a>)</td>
                                            <td><?php echo $order['name'].' '.$order['surname']; ?></td>
                                            <td><?php echo $order['dateOrder']; ?> <?php echo $order['timeOrder']; ?></td>
                                            <td>$<?php echo $order['payment']; ?></td>
                                            <td width="25%"><?php echo $order['address']; ?></td>
                                            <td>
                                            <?php if($order['status']=='pending'){ ?>
                                                <button class="btn btn-danger btn-sm">În așteptare</button>
                                            <?php }else{ ?>
                                                <button class="btn btn-success btn-sm" onclick="openform()">Livrat</button>
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
                        <span>Copyright &copy; Restaurant 2021</span>
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
    <script>
        
    </script>

</body>

</html>