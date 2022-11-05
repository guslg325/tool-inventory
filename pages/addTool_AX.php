<?php
	include('./../../db_connection.php');
	$respAX = array();
	if(isset($_POST["toolName"])&&isset($_POST["cabinet"])&&isset($_POST["shelf"])&&isset($_POST["toolDescription"])&&isset($_FILES["photo"])){
		//Get POST data
		$name = $_POST["toolName"];
		$cabID = $_POST["cabinet"];
		$shelf = $_POST["shelf"];
		$description = $_POST["toolDescription"];
		$photo = $_FILES["photo"];

		//Save img
		$dirUploads = "./../files/";
		$photoURL = $dirUploads.$photo["name"];
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
				$sql = "INSERT INTO tool(Tool_Name, Storage_Cabinet, Cabinet_Shelf, Tool_ImgURL, Tool_Details, Usage_Status, Tool_Created, Tool_Modified) VALUES ('$name','$cabID','$shelf','$rows[0]','$description',0,NOW(),NOW())";
				$result = mysqli_query($connection,$sql);
				if(mysqli_affected_rows($connection)==1){
					//Success
					$respAX["code"] = 0;
					$respAX["msj"] = "<h7>Herramienta agregada.</h7>";
				}else{
					//Error
					$respAX["code"] = -1;
					$respAX["msj"] = "<h7>Error al agregar herramienta.</h7>";
				}
			}else{
				$respAX["code"] = -1;
				$respAX["msj"] = "<h7>Error al guardar dirección de imagen.</h7>";
			}
		}else{
			$respAX["code"] = -1;
			$respAX["msj"] = "<h7>Error al guardar imagen.</h7>";
		}
	}else{
		$respAX["code"] = -1;
		$respAX["msj"] = "<h7>Error al obtener datos de POST.</h7>";
	}

	echo json_encode($respAX);
?>