<?php
	$enlace = mysqli_connect("localhost","root","");
    mysqli_select_db($enlace, "cafeteria");
	$id = mysqli_real_escape_string($enlace, $_POST['id']);
	$reponse = array("deleted_query" => false);
	$delete_query = "DELETE FROM usuario WHERE id_usuario = $id";
	mysqli_query($enlace, $delete_query);
	if (mysqli_affected_rows($enlace) > 0) {
		$response['delete_query'] = true;
	}
	mysqli_close($enlace);
	echo json_encode($reponse);
?>