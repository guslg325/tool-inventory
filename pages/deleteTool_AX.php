<?php
	include('./../../db_connection.php');

	$respAX = array();

	if(isset($_POST["id"])){
		$idTool = $_POST["id"];

		$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		$sql = "UPDATE tool SET Usage_Status = 2, Tool_Modified = NOW() WHERE ID_Tool = $idTool";
		$res = mysqli_query($connection,$sql);

		$respAX["code"] = 0;
		$respAX["msj"] = "Herramienta eliminada.";
	}else{
		$respAX["code"] = -1;
		$respAX["msj"] = "Error al obtener datos de POST.";
	}

	echo json_encode($respAX);
?>