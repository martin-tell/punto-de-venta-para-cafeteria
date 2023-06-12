<?php
	$enlace = mysqli_connect("localhost","root","");
    mysqli_select_db($enlace, "cafeteria");
	$name = mysqli_real_escape_string($enlace, $_POST['name']);
	$last = mysqli_real_escape_string($enlace, $_POST['last']);
	$user = mysqli_real_escape_string($enlace, $_POST['user']);
	$mail = mysqli_real_escape_string($enlace, $_POST['mail']);
	$pass = mysqli_real_escape_string($enlace, $_POST['pass']);
	$pass2 = mysqli_real_escape_string($enlace, $_POST['pass2']);
	$queryUser = "SELECT * FROM usuario WHERE nombre_usuario = '$user'";
	$resultUser = mysqli_query($enlace, $queryUser);
	$queryMail = "SELECT * FROM usuario WHERE correo_electronico = '$mail'";
	$resultMail = mysqli_query($enlace, $queryMail);
	$existing_data = array('user' => false, 'mail' => false, 'pass_match' => false,'insert' => false);
	if (mysqli_num_rows($resultUser) > 0) {
		$existing_data['user'] =  true;
	}
	if (mysqli_num_rows($resultMail) > 0) {	
		$existing_data['mail'] =  true;
	}
	if ($pass == $pass2) {	
		$existing_data['pass_match'] = true;
	}
	if(!$existing_data['user'] && !$existing_data['mail'] && $existing_data['pass_match']){
		$insert1 = "INSERT INTO Usuario (nombre_de_pila, nombre_usuario, correo_electronico, contrasena, rol)";
		$insert2 = "VALUES ('$name $last', '$user', '$mail', '$pass', 'cliente')";
		mysqli_query($enlace, $insert1.$insert2);
		if (mysqli_affected_rows($enlace) == 1)
			$existing_data['insert'] =  true;
	}
	echo json_encode($existing_data);
?>