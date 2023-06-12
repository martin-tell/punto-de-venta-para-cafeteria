<?php
	$enlace = mysqli_connect("localhost","root","");
    mysqli_select_db($enlace, "cafeteria");
	$id = mysqli_real_escape_string($enlace, $_POST['id_up']);
	$name = mysqli_real_escape_string($enlace, $_POST['name_up']);
	$user = mysqli_real_escape_string($enlace, $_POST['user_up']);
	$mail = mysqli_real_escape_string($enlace, $_POST['mail_up']);
	$type = mysqli_real_escape_string($enlace, $_POST['tipo_up']);
	$old_user = mysqli_real_escape_string($enlace, $_POST['oldName_up']);
	$old_mail = mysqli_real_escape_string($enlace, $_POST['oldMail_up']);

	$queryUser = "SELECT * FROM usuario WHERE nombre_usuario = '$user'";
	$resultUser = mysqli_query($enlace, $queryUser);
	$queryMail = "SELECT * FROM usuario WHERE correo_electronico = '$mail'";
	$resultMail = mysqli_query($enlace, $queryMail);
	$existing_data = array('update_user' => false, 'same_user' => false, 'update_mail' => false, 'same_mail' => false, 'update_missing' => false, 'query' => false, 'user' => false, 'mail' => false);
	if($user != $old_user){
		if (mysqli_num_rows($resultUser) > 0) {	
			$existing_data['user'] =  true;
		}
		if(!$existing_data['user']){
			$update = "UPDATE Usuario SET nombre_usuario = '$user' WHERE id_usuario = $id";
			$result = mysqli_query($enlace, $update);
			if($result){
				if(mysqli_affected_rows($enlace) > 0){
					$existing_data['update_user'] =  true;
				}
			}	
		}
	}else{
		$existing_data['same_user'] =  true;
	}
	if($mail != $old_mail){
		if (mysqli_num_rows($resultMail) > 0) {	
			$existing_data['mail'] =  true;
		}
		if(!$existing_data['mail']){
			$update = "UPDATE Usuario SET correo_electronico = '$mail' WHERE id_usuario = $id";
			$result = mysqli_query($enlace, $update);
			if($result){
				if(mysqli_affected_rows($enlace) > 0){
					$existing_data['update_mail'] =  true;
				}
			}	
		}
	}else{
		$existing_data['same_mail'] =  true;
	}
	$update = "UPDATE Usuario SET nombre_de_pila = '$name', rol = '$type' WHERE id_usuario = $id";
	$result = mysqli_query($enlace, $update);
	if($result){
		if(mysqli_affected_rows($enlace) > 0){
			$existing_data['update_missing'] =  true;
		}
	}
	echo json_encode($existing_data);
?>