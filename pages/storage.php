<?php
	include('./../../db_connection.php');
	$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	$sql = "SELECT * FROM cabinet INNER JOIN imageurl ON cabinet.Cabinet_ImgURL = imageurl.ID_URL WHERE Cabinet_Status = 0 ORDER BY Cabinet_Name ASC";
	$res = mysqli_query($connection,$sql);
	$cards = "";

	while($rows = mysqli_fetch_array($res,2)){
		$cards .= "
		<div class='row'>
			<div class='col s12'>
				<div class='card horizontal grey darken-3'>
					<!--Card-->
					<div class='card-image'>
						<!--Image-->
						<img class='responsive-img tool-img' src=$rows[9]>
					</div>
					<div class='card-stacked'>
						<div class='card-content'>
							<!--Text-->
							<b>$rows[1]</b>
							<p>$rows[4]</p>
						</div>
						<div class='card-action'>
							<a class='waves-effect waves-light btn grey darken-1 card-edit' href='./viewStorage.php?idCabinet=$rows[0]'><i class='fas fa-eye'></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>";
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Almacenamiento</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="./../css/main.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="./../js/jquery-3.6.0.js"></script>
<script src="./../js/floatingBtn.js"></script>
</head>
<body class="grey darken-4">
	<header class="navbar-fixed">
		<nav class="nav-extended grey darken-3">
			<div class="nav-wrapper title">
				Almacenamiento
			</div>
			<div class="nav-content">
				<ul class="tabs tabs-transparent">
					<li class="tab"><a href="./../index.php"><i class="fas fa-tools"></i></a></li>
					<li class="tab"><a class="active" href="#"><i class="fas fa-boxes"></i></a></li>
					<li class="tab"><a href="./using.php"><i class="fas fa-user-cog"></i></a></li>
				</ul>
			</div>
		</nav>
	</header>
	<main class="mainDiv">
		<div class="container">
			<!-- <div class="row">
				<form class="col s12" name="storageSearch" id="storageSearch">
					<div class="input-field col s10">
						<input class="white-text" id="search" type="text" class="validate">
						<label class="white-text" for="search">Buscar</label>
					</div>
					<button type="submit" name="btnSearch" id="btnSearch" class="col s2 waves-effect waves-light btn grey darken-3" style="margin-top: 14pt;"><i class="fas fa-search"></i></button>
				</form>
			</div> -->
			<?php
				//Dynamic list
				if($cards != "")
					echo $cards;
				else
					echo "<center><h6>No hay elementos para mostrar.</h6></center>";
			?>
		</div>
		<!--Floating action button-->
		<div class="fixed-action-btn">
			<a class="btn-floating btn-large waves-effect waves-light grey darken-1" href="./addStorage.html">
			  	<i class="fas fa-plus"></i>
			</a>
		</div>
	</main>
</body>
</html>