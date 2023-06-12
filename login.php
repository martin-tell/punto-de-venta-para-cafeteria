<?php
	session_start();
	$enlace = mysqli_connect("localhost","root","");
    mysqli_select_db($enlace, "cafeteria");
	$user_lg = mysqli_real_escape_string($enlace, $_POST['user_lg']);
	$pass_lg = mysqli_real_escape_string($enlace, $_POST['pass_lg']);
	$consulta = "SELECT * FROM usuario WHERE nombre_usuario = '".$user_lg."' AND contrasena = '".$pass_lg."'";
	$usuarios = mysqli_query($enlace, $consulta);
	if(mysqli_num_rows($usuarios) == 1 ){
		$datos = mysqli_fetch_assoc($usuarios);
		$_SESSION['id'] = $datos['id_usuario'];
		$_SESSION['name'] = $datos['nombre_de_pila'];
		$_SESSION['user'] = $datos['nombre_usuario'];
		$_SESSION['mail'] = $datos['correo_electronico'];
		$_SESSION['order'] = null;
		echo json_encode(array('error' => false, 'tipo' => $datos['rol']));
	}else{
		session_destroy();
		echo json_encode(array('error' => true));
	}
?>