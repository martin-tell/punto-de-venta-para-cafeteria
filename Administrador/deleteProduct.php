<?php
	$enlace = mysqli_connect("localhost","root","");
    mysqli_select_db($enlace, "cafeteria");
	$id = mysqli_real_escape_string($enlace, $_POST['id']);
	$old_name = mysqli_real_escape_string($enlace, $_POST['old_name']);
	$response = array('img_error' => false, 'delete' => false);
	$folder = "../imagenes_productos/";
	$reponse = array("file_exist" => false, "file_deleted" => false, "deleted_query" => false);
	if (file_exists($folder.$old_name)) {
		$response['file_exist'] = true;
		if (unlink($folder.$old_name)) {
			$response['file_deleted'] = true;
			$delete_query = "DELETE FROM producto WHERE id_producto = $id";
			mysqli_query($enlace, $delete_query);
			if (mysqli_affected_rows($enlace) > 0) {
				$response['delete_query'] = true;
			}
		}
	} else {
		$delete_query = "DELETE FROM producto WHERE id_producto = $id";
		mysqli_query($enlace, $delete_query);
		if (mysqli_affected_rows($enlace) > 0) {
			$response['delete_query'] = true;
		}
	}
	mysqli_close($enlace);
	echo json_encode($reponse);
	//INSERT INTO Producto (nombre_producto, precio, descripcion, categoria, imagen, disponibilidad) VALUES ('Croissant de chocolate', 4.50, 'Delicioso croissant relleno de chocolate', 'desayuno', 'croissant_chocolate.jpg', true);
?>