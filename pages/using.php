<?php
	include('./../../db_connection.php');
	$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	$sql = "SELECT ID_Tool,Tool_Name,ID_Cabinet,URL_Value,Tool_Details,Status_Value FROM tool INNER JOIN cabinet ON tool.Storage_Cabinet = cabinet.ID_Cabinet INNER JOIN imageurl ON tool.Tool_ImgURL = imageurl.ID_URL INNER JOIN cstatus ON tool.Usage_Status = cstatus.ID_Status WHERE Usage_Status = 1";
	$result = mysqli_query($connection,$sql);

	$cards = "";

	while($rows = mysqli_fetch_array($result,2)){
		$cards .= "
			<div class='row'>
				<div class='col s12'>
					<div class='card horizontal grey darken-3'>
						<div class='card-image'>
							<img class='responsive-img tool-img' src='$rows[3]'>
						</div>
						<div class='card-stacked'>
							<div class='card-content'>
								<b>$rows[1]</b>
								<p>$rows[4]</p>
								&nbsp
								<p><b>Estado de herramienta: </b>$rows[5]</p>
							</div>
							<div class='card-action'>
								<a class='waves-effect waves-light btn grey darken-1 card-edit' href='./viewTool.php?toolID=$rows[0]'><i class='fas fa-eye'></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		";
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Herramientas en uso</title>
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
				Herramientas en uso
			</div>
			<div class="nav-content">
				<ul class="tabs tabs-transparent">
					<li class="tab"><a href="./../index.php"><i class="fas fa-tools"></i></a></li>
					<li class="tab"><a href="./storage.php"><i class="fas fa-boxes"></i></a></li>
					<li class="tab"><a class="active" href="#"><i class="fas fa-user-cog"></i></a></li>
				</ul>
			</div>
		</nav>
	</header>
	<main class="mainDiv">
		<div class="container">
			<?php
				//Dynamic list
				if($cards != "")
					echo $cards;
				else
					echo "<center>&nbsp<h6>No hay herramientas en uso.</h6></center>";
			?>
		</div>
	</main>
</body>
</html>