<?php
include('./../../db_connection.php');
	if(isset($_GET["cabinetID"])&&$_GET["cabinetID"]!=""){
		$cabinetID = $_GET["cabinetID"];

		$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		$sql = "SELECT * FROM cabinet WHERE ID_Cabinet = $cabinetID";
		$res = mysqli_query($connection,$sql);

		$row = mysqli_fetch_array($res,2);

		if(!is_array($row)){
			$cabinetID = null;
			$row[1] = "Error";
			$row[4] = "Error";
			$row[2] = "Error";
		}
	}else{
		$cabinetID = null;
		$row[1] = "Error";
		$row[4] = "Error";
		$row[2] = "Error";
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Modificar almacenamiento</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="./../css/main.css">
<link rel="stylesheet" href="./../js/plugins/validetta-v1.0.1/validetta.min.css">
<link rel="stylesheet" href="./../js/plugins/jquery-confirm-v3.3.4/css/jquery-confirm.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="./../js/jquery-3.6.0.js"></script>
<script src="./../js/floatingBtn.js"></script>
<script src="./../js/plugins/validetta-v1.0.1/validetta.min.js"></script>
<script type="text/javascript" src="./../js/plugins/validetta-v1.0.1/validettaLang-es-ES.js"></script>
<script src="./../js/plugins/jquery-confirm-v3.3.4/js/jquery-confirm.js"></script>
<script src="./../js/updateStorage.js"></script>
</head>
<body class="grey darken-4">
	<header class="navbar-fixed">
		<nav class="grey darken-3">
			<div class="nav-wrapper title">
				<a href="./viewStorage.php?idCabinet=<?php echo $cabinetID?>" class="backBtn"><i class="fas fa-arrow-left"></i></a>
				Modificar almacenamiento
			</div>
		</nav>
	</header>
	<main class="mainDiv">
		<div class="container">
			<form name="formUpdateStorage" id="formUpdateStorage" autocomplete="off">
			<input class="white-text" id="storageID" name="storageID" type="text" class="validate" data-validetta="required" value="<?php echo $cabinetID?>" hidden>
				<div class="row">
					<div class="input-field col s12">
						<input class="white-text" id="storageName" name="storageName" type="text" class="validate" data-validetta="required" value="<?php echo $row[1]?>">
						<label class="white-text" for="storageName">Nombre de mueble</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input class="white-text" id="storageShelfs" name="storageShelfs" type="text" class="validate" data-validetta="required,number" value="<?php echo $row[2]?>">
						<label class="white-text" for="storageShelfs">Numero de repisas/cajones</label>
					</div>
				</div>
				<div class="row">
					<div class="file-field input-field">
						<div class="btn grey darken-3">
							<span><i class="fas fa-file"></i></span>
							<input type="file" id="photo" name="photo" data-validetta="required">
						</div>
						<div class="file-path-wrapper">
						  	<input class="file-path validate white-text" type="text">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<textarea class="white-text materialize-textarea" id="storageDescription" name="storageDescription"><?php echo $row[4]?></textarea>
						<label class="white-text" for="storageDescription">Descripcion y detalles adicionales</label>
					</div>
				</div>
				<div class="row">
					<button type="submit" class="btn grey darken-3" style="width: 100%;">Modificar</button>
				</div>
			</form>
		</div>
	</main>
</body>
</html>