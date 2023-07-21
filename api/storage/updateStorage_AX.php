<?php
	include('./../../../db_connection.php');
	$respAX_JSON = array();
	//Get POST data
	if(isset($_POST["storageID"])&&isset($_POST["storageName"])&&isset($_POST["storageShelfs"])&&isset($_POST["storageDescription"])&&isset($_FILES["photo"])){
		$respAX_JSON["code"] = 0;
		$respAX_JSON["msj"] = "<h7>Good.</h7>";
		$cabinetID = $_POST["storageID"];
		$name = $_POST["storageName"];
		$shelfs = $_POST["storageShelfs"];
		$details = $_POST["storageDescription"];
		$photo = $_FILES["photo"];
		$photoURL;

		//Get consecutive number for img
		$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		$sql = "SELECT MAX(ID_URL) FROM imageurl";
		$result = mysqli_query($connection,$sql);
		$consecutive = mysqli_fetch_array($result,2);

		//Save img
		$dirUploads = "./../files/";//Save on this dir
		$photoURL = $dirUploads."ST-".($consecutive[0]+1);//dir+consecutive

		if(move_uploaded_file($photo["tmp_name"],$photoURL)){
			//Update URL in DB
			$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
			$sqlURL = "SELECT * FROM cabinet WHERE ID_Cabinet = $cabinetID";
			$result = mysqli_query($connection,$sqlURL);
			$rowURL = mysqli_fetch_array($result,2);

			//Update URL to DB
			$sql = "UPDATE imageurl SET URL_Value = '$photoURL' WHERE ID_URL = $rowURL[3]";
			$result = mysqli_query($connection,$sql);
			if($result){
				//Insert OK update cabinet in DB			
				$sql = "UPDATE cabinet SET Cabinet_Name = '$name', Cabinet_Shelfs = $shelfs, Cabinet_ImgURL = $rowURL[3], Cabinet_Details = '$details', Cabinet_Modified = NOW() WHERE ID_Cabinet = $cabinetID";
				$result = mysqli_query($connection,$sql);
				if($result){
					//Success
					$respAX_JSON["code"] = 0;
					$respAX_JSON["msj"] = "<h7>Modificación realizada.</h7>";
				}else{
					//Error
					$respAX_JSON["code"] = -1;
					$respAX_JSON["msj"] = "<h7>Error al modificar datos.</h7>";
				}
			}else{
				//Error adding URL to DB
				$respAX_JSON["code"] = -1;
				$respAX_JSON["msj"] = "<h7>Error al actualizar imagen en la base de datos.</h7>";
			}
		}else{
			//Error
			$respAX_JSON["code"] = -1;
			$respAX_JSON["msj"] = "<h7>Error al cargar imagen.</h7>";
		}
	}else{
		//Error
		$respAX_JSON["code"] = -1;
		$respAX_JSON["msj"] = "<h7>Error en AJAX.</h7>";
	}

	echo json_encode($respAX_JSON);
?>