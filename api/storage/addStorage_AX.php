<?php
	include('./../../../db_connection.php');

	$respAX_JSON = array();
	//Get POST data
	if(isset($_POST["storageName"])&&isset($_POST["storageShelfs"])&&isset($_POST["storageDescription"])&&isset($_FILES["photo"])){
		$name = $_POST["storageName"];
		$shelfs = $_POST["storageShelfs"];
		$details = $_POST["storageDescription"];
		$photo = $_FILES["photo"];

		//Get consecutive number for img
		$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		$sql = "SELECT MAX(ID_URL) FROM imageurl";
		$result = mysqli_query($connection,$sql);
		$consecutive = mysqli_fetch_array($result,2);

		//Save img
		$dirUploads = "./../files/";//Save on this dir
		$photoURL = $dirUploads."ST-".($consecutive[0]+1);//dir+consecutive

		if(move_uploaded_file($photo["tmp_name"],$photoURL)){
			//Add URL to DB
			$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);

			$sql = "INSERT INTO imageurl(URL_Value) VALUES ('$photoURL')";
			$result = mysqli_query($connection,$sql);
			if(mysqli_affected_rows($connection)==1){
				//Insert OK, get URL id
				$photoURLIdSQL = "SELECT ID_URL FROM imageurl WHERE URL_Value = '$photoURL'";
				$photoURLIdRes = mysqli_query($connection,$photoURLIdSQL);
				$rows = mysqli_fetch_array($photoURLIdRes,2);

				//Add cabinet to DB			
				$sql = "INSERT INTO cabinet(Cabinet_Name, Cabinet_Shelfs, Cabinet_ImgURL, Cabinet_Details, Cabinet_Created, Cabinet_Modified) VALUES ('$name','$shelfs','$rows[0]','$details',NOW(),NOW())";
				$result = mysqli_query($connection,$sql);
				if(mysqli_affected_rows($connection)==1){
					//Success
					$respAX_JSON["code"] = 0;
					$respAX_JSON["msj"] = "<h7>Registro realizado con éxito.</h7>";
				}else{
					//Error
					$respAX_JSON["code"] = -1;
					$respAX_JSON["msj"] = "<h7>Error al agregar nuevo almacenamiento.</h7>";
				}
			}else{
				//Error adding URL to DB
				$respAX_JSON["code"] = -1;
				$respAX_JSON["msj"] = "<h7>Error al añadir imagen a la base de datos.</h7>";
			}
		}else{
			//Error
			$respAX_JSON["code"] = -1;
			$respAX_JSON["msj"] = "<h7>Error al cargar imagen.</h7>";
		}
	}else{
		//Error
		$respAX_JSON["code"] = -1;
		$respAX_JSON["msj"] = "<h7>Error al obtener datos de POST.</h7>";
	}

	echo json_encode($respAX_JSON);
?>