<?php
	include('./../../db_connection.php');
	if(isset($_GET["idCabinet"])&&$_GET["idCabinet"]!=""){
		$cabinetID = $_GET["idCabinet"];

		$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		$sql = "SELECT * FROM cabinet WHERE ID_Cabinet = $cabinetID";
		$res = mysqli_query($connection,$sql);

		$row = mysqli_fetch_array($res,2);

		if(!is_array($row)){
			$cabinetID = null;
			$imgURL = "./../img/error.png";
			$row[1] = "Error";
			$row[2] = "Error";
			$row[4] = "Error";
		}else{
			$sql2 = "SELECT * FROM imageurl WHERE ID_URL = $row[3]";
			$res2 = mysqli_query($connection,$sql2);
			$row2 = mysqli_fetch_array($res2,2);
			$imgURL = $row2[1];
		}		
	}else{
		$cabinetID = null;
		$imgURL = "./../img/error.png";
		$row[1] = "Error";
		$row[2] = "Error";
		$row[4] = "Error";
	}	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Detalle de almacenamiento</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="./../css/main.css">
<link rel="stylesheet" href="./../js/plugins/jquery-confirm-v3.3.4/css/jquery-confirm.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="./../js/jquery-3.6.0.js"></script>
<script src="./../js/floatingBtn.js"></script>
<script src="./../js/plugins/jquery-confirm-v3.3.4/js/jquery-confirm.js"></script>
<script src="./../js/viewStorage.js"></script>
</head>
<body class="grey darken-4">
	<header class="navbar-fixed">
		<nav class="grey darken-3">
			<div class="nav-wrapper title">
				<a href="./storage.php" class="backBtn"><i class="fas fa-arrow-left"></i></a>
				<?php echo $row[1];?>
			</div>
		</nav>
	</header>
	<main class="mainDiv">
		<div class="container">
			<div class="row">
				<div class="col s12">
					<img class="responsive-img center-block" src="./<?php echo $imgURL;?>">
				</div>
			</div>
			<div class="row">
				<div class="col s12"><b>Numero de repisas/Cajones</b></div>
				<div class="col s12"><?php echo $row[2];?></div>
			</div>
			<div class="row">
				<div class="col s12"><b>Detalles</b></div>
				<div class="col s12"><?php echo $row[4];?></div>
			</div>
		</div>
		<!--Floating action button-->
		<div class="fixed-action-btn">
			<a class="btn-floating btn-large waves-effect waves-light grey darken-1">
				<i class="fas fa-ellipsis-h"></i>
			</a>
			<ul>
				<li><a class="btn-floating btn-large red darken-1 deleteStorage" data-storage="<?php echo $cabinetID?>"><i class="fas fa-trash"></i></a></li>
				<li><a class="btn-floating btn-large grey darken-1" href="./updateStorage.php?cabinetID=<?php echo $cabinetID?>"><i class="fas fa-pen"></i></a></li>
			</ul>
		</div>
	</main>
</body>
</html>