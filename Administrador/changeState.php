<?php
	$enlace = mysqli_connect("localhost", "root", "");
	mysqli_select_db($enlace, "cafeteria");
	
	// Obtener el ID del pedido a actualizar
	$id_pedido = $_POST['id_pedido'];
	$nuevo_estado = $_POST['estado'];

	// Consulta para actualizar el estado del pedido
	$query = "UPDATE Pedido SET estado = '$nuevo_estado' WHERE id_pedido = $id_pedido";
	$result = mysqli_query($enlace, $query);

	$response = array();

	if ($result) {
	  $response['success'] = true;
	  $response['message'] = "Se ha actualizado el estado del pedido correctamente.";
	} else {
	  $response['success'] = false;
	  $response['message'] = "Error al actualizar el estado del pedido: " . mysqli_error($enlace);
	}

	echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>