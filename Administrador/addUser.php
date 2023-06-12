<?php
	$enlace = mysqli_connect("localhost","root","");
    mysqli_select_db($enlace, "cafeteria");
	$name = mysqli_real_escape_string($enlace, $_POST['name']);
	$user = mysqli_real_escape_string($enlace, $_POST['user']);
	$mail = mysqli_real_escape_string($enlace, $_POST['mail']);
	$type = mysqli_real_escape_string($enlace, $_POST['tipo']);
	$pass = mysqli_real_escape_string($enlace, $_POST['pass']);
	
	$queryUser = "SELECT * FROM usuario WHERE nombre_usuario = '$user'";
	$resultUser = mysqli_query($enlace, $queryUser);
	$queryMail = "SELECT * FROM usuario WHERE correo_electronico = '$mail'";
	$resultMail = mysqli_query($enlace, $queryMail);
	$existing_data = array('add' => false, 'query'=> false, 'user' => false, 'mail' => false);
	if (mysqli_num_rows($resultUser) > 0) {	
		$existing_data['user'] =  true;
	}
	if (mysqli_num_rows($resultMail) > 0) {	
		$existing_data['mail'] =  true;
	}
	if(!$existing_data['user'] and !$existing_data['mail']){
		$query = "INSERT INTO Usuario (nombre_de_pila, nombre_usuario, correo_electronico, contrasena, rol) VALUES ('$name', '$user', '$mail', '$pass', '$type')";
		$result = mysqli_query($enlace, $query);
		if($result){
			$existing_data['query'] = true;
			if(mysqli_affected_rows($enlace) > 0){
				$existing_data['add'] =  true;
			}
		}
	}
	echo json_encode($existing_data);
?>