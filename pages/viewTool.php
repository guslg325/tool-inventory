<?php
	include('./../../db_connection.php');
	if(isset($_GET["toolID"])&&$_GET["toolID"]!=""){
		$idTool = $_GET["toolID"];
		$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		$sql = "SELECT ID_Tool,Tool_Name,Cabinet_Name,Cabinet_Shelf,URL_Value,Tool_Details,Status_Value FROM tool INNER JOIN cabinet ON tool.Storage_Cabinet = cabinet.ID_Cabinet INNER JOIN imageurl ON tool.Tool_ImgURL = imageurl.ID_URL INNER JOIN cstatus ON tool.Usage_Status = cstatus.ID_Status WHERE ID_Tool = $idTool";
		$result = mysqli_query($connection,$sql);
		
		$row = mysqli_fetch_array($result,2);
		if(!is_array($row)){
			$row[1] = "Error";
			$row[2] = "Error";
			$row[3] = "Error";
			$row[4] = "./../img/error.png";
			$row[5] = "Error";
			$row[6] = "Error";
		}
	}else{
		$row[1] = "Error";
		$row[2] = "Error";
		$row[3] = "Error";
		$row[4] = "./../img/error.png";
		$row[5] = "Error";
		$row[6] = "Error";
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Detalle de herramienta</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="./../js/plugins/jquery-confirm-v3.3.4/css/jquery-confirm.css">
<link rel="stylesheet" href="./../css/main.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="./../js/jquery-3.6.0.js"></script>
<script src="./../js/floatingBtn.js"></script>
<script src="./../js/plugins/jquery-confirm-v3.3.4/js/jquery-confirm.js"></script>
<script src="./../js/viewTool.js"></script>
</head>
<body class="grey darken-4">
	<header class="navbar-fixed">
		<nav class="grey darken-3">
			<div class="nav-wrapper title">
				<a href="./../index.php" class="backBtn"><i class="fas fa-arrow-left"></i></a>
				<?php echo $row[1]?>
			</div>
		</nav>
	</header>
	<main class="mainDiv">
		<div class="container">
			<div class="row">
				<div class="col s12">
					<img class="responsive-img center-block" src="<?php echo $row[4]?>">
				</div>
			</div>
			<div class="row">
				<div class="col s12"><b>Estado</b></div>
				<div class="col s12 toolStatus" stat="<?php echo $row[6]?>"><?php echo $row[6]?></div>
			</div>
			<div class="row">
				<div class="col s12"><b>Lugar de almacenamiento</b></div>
				<div class="col s12"><?php echo $row[2]?></div>
			</div>
			<div class="row">
				<div class="col s12"><b>Repisa/Cajón</b></div>
				<div class="col s12"><?php echo $row[3]?></div>
			</div>
			<div class="row">
				<div class="col s12"><b>Descripción y detalles</b></div>
				<div class="col s12"><?php echo $row[5]?></div>
			</div>
		</div>
		<!--Floating action button-->
		<div class="fixed-action-btn">
			<a class="btn-floating btn-large waves-effect waves-light grey darken-1">
				<i class="fas fa-ellipsis-h"></i>
			</a>
			<ul>
				<li><a class="btn-floating btn-large red darken-1 deleteTool" data-tool="<?php echo $idTool?>"><i class="fas fa-trash"></i></a></li>
				<li><a class="btn-floating btn-large grey darken-1 updateTool" data-tool="<?php echo $idTool?>"><i class="fas fa-pen"></i></a></li>
				<li><a class="btn-floating btn-large grey darken-1 useTool" data-tool="<?php echo $idTool?>"><i class="fas fa-play dynamic"></i></a></li>
			</ul>
		</div>
	</main>
</body>
</html>