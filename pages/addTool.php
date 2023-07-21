<?php
	include('./../../db_connection.php');
	if(isset($_GET["cabID"])&&isset($_GET["toolName"])){
		$cabID = $_GET["cabID"];
		$toolName = $_GET["toolName"];

		$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		$sql = "SELECT * FROM cabinet WHERE Cabinet_Status = 0 ORDER BY Cabinet_Name ASC";
		$res = mysqli_query($connection,$sql);

		$cabOptions = "";
		$shelfOptions = "";
		$itrControl = 1;

		while($rows = mysqli_fetch_array($res,2)){
			if($rows[0]==$cabID){
				$cabOptions .= "
					<option value=".$rows[0]." selected>$rows[1]</option>
				";
			}else{
				$cabOptions .= "
					<option value=".$rows[0].">$rows[1]</option>
				";
			}

			$itrControl++;
		}

		$sql = "SELECT * FROM cabinet WHERE ID_Cabinet = $cabID";
		$res = mysqli_query($connection,$sql);
		$row = mysqli_fetch_array($res,2);

		$itrControl = 1;
		while($itrControl <= $row[2]){
			$shelfOptions .= "
				<option value='$itrControl'>$itrControl</option>
			";
			$itrControl++;
		}
	}else{
		$connection = mysqli_connect("localhost","root","","db_toolinventory");
		$sql = "SELECT * FROM cabinet WHERE Cabinet_Status = 0 ORDER BY Cabinet_Name ASC";
		$res = mysqli_query($connection,$sql);
		$toolName = "";

		$cabOptions = "";
		$shelfOptions = "";
		$itrControl = 1;

		while($rows = mysqli_fetch_array($res,2)){
			$cabOptions .= "
				<option value=".$rows[0].">$rows[1]</option>
			";

			$itrControl++;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Agregar herramienta</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="./../js/plugins/validetta-v1.0.1/validetta.min.css">
<link rel="stylesheet" href="./../js/plugins/jquery-confirm-v3.3.4/css/jquery-confirm.css">
<link rel="stylesheet" href="./../css/main.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="./../js/jquery-3.6.0.js"></script>
<script src="./../js/plugins/validetta-v1.0.1/validetta.min.js"></script>
<script type="text/javascript" src="./../js/plugins/validetta-v1.0.1/validettaLang-es-ES.js"></script>
<script src="./../js/plugins/jquery-confirm-v3.3.4/js/jquery-confirm.js"></script>
<script src="./../js/floatingBtn.js"></script>
<script src="./../js/addTool.js"></script>
</head>
<body class="grey darken-4">
	<header class="navbar-fixed">
		<nav class="grey darken-3">
			<div class="nav-wrapper title">
				<a href="./../index.php" class="backBtn"><i class="fas fa-arrow-left"></i></a>
				Agregar herramienta
			</div>
		</nav>
	</header>
	<main class="mainDiv">
		<div class="container">
			<form enctype="multipart/form-data" name="formAddTool" id="formAddTool">
				<div class="row">
					<div class="input-field col s12">
						<input class="white-text" id="toolName" name="toolName" type="text" class="validate" value="<?php echo $toolName?>" data-validetta="required">
						<label class="white-text" for="toolName">Nombre de herramienta</label>
					</div>
				</div>
				<div class="row" style="background-color: #505050; border-radius: 5px; padding: 5px;">
					<div class="input-field col s12">
						<select class="cabinet" name="cabinet" id="cabinet" data-validetta='minSelected[1]'>
							<option value="" disabled selected>Elegir opción...</option>
							<?php echo $cabOptions?>
						</select>
						<label class="white-text">Mueble de almacenaje</label>
					  </div>
				</div>
				<div class="row" style="background-color: #505050; border-radius: 5px; padding: 5px;">
					<div class="input-field col s12">
						<select class="shelf" name="shelf" id="shelf" data-validetta='minSelected[1]'>
							<option value="" disabled selected>Elegir opción...</option>
							<?php echo $shelfOptions?>
						</select>
						<label class="white-text">Repisa/cajón del mueble</label>
					  </div>
				</div>
				<div class="row">
					<div class="file-field input-field">
						<div class="btn grey darken-3">
							<span><i class="fas fa-file"></i></span>
							<input type="file" name="photo" id="photo" data-validetta="required">
						</div>
						<div class="file-path-wrapper">
						  	<input class="file-path validate white-text" type="text">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<textarea class="white-text materialize-textarea" id="toolDescription" name="toolDescription"></textarea>
						<label class="white-text" for="toolDescription">Descripcion y detalles adicionales</label>
					</div>
				</div>
				<div class="row">
					<button type="submit" class="btn grey darken-3" style="width: 100%;">Agregar</button>
				</div>
			</form>
		</div>
	</main>
</body>
</html>
