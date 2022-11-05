<?php
	include('./../../db_connection.php');
	$idCabinet = $_POST["id"];
	$respAX_JSON = array();

	$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	$sql = "UPDATE cabinet SET Cabinet_Modified = NOW(), Cabinet_Status = '1' WHERE cabinet.ID_Cabinet = $idCabinet";
	$res = mysqli_query($connection,$sql);

	if(mysqli_affected_rows($connection)==1){
		//Updated 
		$respAX_JSON["code"] = 0;
		$respAX_JSON["msj"] = "<h7>Almacenamiento eliminado.</h7>";
	}else{
		//Error
		$respAX_JSON["code"] = -1;
		$respAX_JSON["msj"] = "<h7>Error al eliminar almacenamiento, múltiples modificaciones.</h7>";
	}

	echo json_encode($respAX_JSON);
?>