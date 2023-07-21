<?php 
	include('./../../../db_connection.php');
	$respAX = array();
	if(isset($_POST["id"])){
		$idTool = $_POST["id"];

		$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		
		//Get current status
		$sql = "SELECT Usage_Status FROM tool WHERE ID_Tool = $idTool";
		$result = mysqli_query($connection,$sql);
		$row = mysqli_fetch_array($result,2);

		//Set new status
		switch($row[0]){
			case 0:
				//Isn't being used, change to using
				$sql = "UPDATE tool SET Usage_Status = 1 WHERE ID_Tool = $idTool";
				$result = mysqli_query($connection,$sql);

				$respAX["code"] = 0;
				$respAX["msj"] = "Estado de uso actualizado.";

				break;
			case 1:
				//Is being used, change to not using
				$sql = "UPDATE tool SET Usage_Status = 0 WHERE ID_Tool = $idTool";
				$result = mysqli_query($connection,$sql);

				$respAX["code"] = 0;
				$respAX["msj"] = "Estado de uso actualizado.";

				break;
			case 2:
				//Is deleted, can't change status
				$respAX["code"] = -1;
				$respAX["msj"] = "Herramienta eliminada, imposible cambiar estado de uso.";

				break;
			default:
				$respAX["code"] = -1;
				$respAX["msj"] = "Error: Estado de uso desconocido.";
		}
	}else{
		$respAX["code"] = -1;
		$respAX["msj"] = "Error al obtener datos de POST.";
	}

	echo json_encode($respAX);
?>