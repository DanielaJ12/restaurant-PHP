<?php
include '../includes/dbd.inc.php';
if(isset($_POST['catid'])&& !empty($_POST['catid']))
{
	$stmt = $sql->prepare("
	DELETE from `p_takepartfrom` where `idCategory`=?");
    $stmt->bindParam(1, $_POST['catid'], PDO::PARAM_STR);
    $stmt->execute();
	
	
	$stmt1 = $sql->prepare("
	DELETE from `p_category` where `idCategory`=?");
    $stmt1->bindParam(1, $_POST['catid'], PDO::PARAM_STR);
    $stmt1->execute();
    
	header("Location:categories.php?msg=1");
	exit();
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>delete Record</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Ștergere Categorie</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            
							<input type="hidden" name="catid" value="<?php echo trim($_GET["catid"]); ?>"/>
                            <p>Sunteți sigur/ă că doriți să ștergeți această categorie?</p><br>
							<p>Avertisment : Categoria conține produse.</p><br>
                            <p>
                                <input type="submit" value="Da" class="btn btn-danger">
                                <a href="categories.php" class="btn btn-default">Nu</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>