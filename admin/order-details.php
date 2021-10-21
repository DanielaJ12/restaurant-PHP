<?php
session_start();
include '../includes/dbd.inc.php';
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}

$stmt = $sql->prepare("Select a.*, b.name, b.surname, b.email, b.phone from p_order as a left join p_client as b on a.IdClient=b.idClient where a.idOrder=?");
$stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$orderdata = $stmt->fetch();
$stmt = $sql->prepare("select * from p_choose where idOrder=?");
$stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$orderproducts = $stmt->fetchAll();

if(isset($_POST['deliverOrder'])){
    $stmt = $sql->prepare("update p_order set status='delivered' where idOrder=?");
    $stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $msg = '<div class="alert alert-success">Comandă livrată cu succes!</div>';
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

    <title>Comanda #<?php echo $orderdata['idOrder']; ?> Detalii</title>

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
                    <?php if(isset($msg)){ echo $msg; } ?>
                    <div class="card shadow mb-4">
                       
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Comanda #<?php echo $orderdata['idOrder']; ?> detalii
                            <span class="float-right">
                                <a class="btn btn-primary btn-sm" href="orders.php">Înapoi la lista comenzilor</a>
                            </span>
                            </h6>
                        </div>
                        <div class="card-body">
                           <?php if(isset($response['message'])){ echo $response['message']; } ?>
                            <div class="table-responsive">
                               
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                               <tr>
                                    <th>Status</th>
                                    <td style="display:flex">
                                        <?php if($orderdata['status']!='delivered'){ ?>
                                        <form action="" method="post" onsubmit="return confirm('Sunteți sigur/ă că doriți să marcați comanda ca livrată?')">
                                             <input type="hidden" name="order_id" value="<?php echo $orderdata['idOrder']; ?>">
                                             <button class="btn btn-success btn-sm" name="deliverOrder">Marchează ca livrat</button>
                                        </form>
                                        
                                        <?php } ?>
                                        <div class="ml-2">
                                            <?php if($orderdata['status']=='pending'){ ?>
                                                <button class="btn btn-warning btn-sm">În așteptare</button>
                                            <?php }else{ ?>
                                                <button class="btn btn-success btn-sm">Livrat</button>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Utilizator</th>
                                    <td>
                                        <?php  
                                            echo $orderdata['name'].' '.$orderdata['surname'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <?php  
                                            echo $orderdata['email'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Telefon</th>
                                    <td>
                                        <?php  
                                            echo $orderdata['phone'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ora Plasării</th>
                                    <td><?php echo $orderdata['dateOrder']; ?> <?php echo $orderdata['timeOrder']; ?></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td><?php echo $orderdata['payment']; ?> Lei</td>
                                </tr>
                                <tr>
                                    <th>Adresa de Livrare</th>
                                    <td><?php echo $orderdata['address']; ?></td>
                                </tr>
                                <tr>
                                    <th>Descriere</th>
                                    <td><?php echo $orderdata['notes']; ?></td>
                                </tr>
                                
                                
                                </table>
                               
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Produs</th>
                                            <th>Cantitate</th>
                                            <th>Pret</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $total = 0;
                                            foreach($orderproducts as $product){
                                                $stmt = $sql->prepare("Select * from p_product where idProduct=?");
                                                $stmt->bindParam(1, $product['idProduct'], PDO::PARAM_INT);
                                                $stmt->execute();
                                                $pdata = $stmt->fetch();
                                        ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                    echo $pdata['name'];
                                                ?>
                                            </td>
                                            <td><?php echo $product['quantity']; ?></td>
                                            <td><?php echo $product['price']; ?> Lei</td>
                                            <td><?php echo $product['quantity']*$product['price']; ?> Lei</td>
                                            
                                        </tr>
                                        <?php $total+=$product['quantity']*$product['price']; } ?>
                                        <tr>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                            <td>
                                                <b><?php echo $total; ?> Lei</b>
                                            </td>
                                        </tr>
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
        if(confirm('Are you sure want to delete?')){
            $("#deleteForm").submit();
        }
    })
        
    $(".edit").click(function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        $("#editid").val(id);
        $("#editname").val(name);
        $("#editModal").modal("show");
    })
    </script>

</body>

</html>