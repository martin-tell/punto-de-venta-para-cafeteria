<?php
	$enlace = mysqli_connect("localhost", "root", "");
	mysqli_select_db($enlace, "cafeteria");

	$busqueda = $_POST['busqueda'];

	$response = array("activos" => array(), "finalizados" => array());

	// Consulta para obtener los pedidos activos que coinciden con la búsqueda
	$queryActivos = "SELECT * FROM Pedido WHERE estado IN ('En espera', 'En preparación', 'En camino') AND (fecha LIKE '%$busqueda%' OR estado LIKE '%$busqueda%' OR id_pedido LIKE '%$busqueda%' OR id_usuario LIKE '%$busqueda%' OR metodo_pago LIKE '%$busqueda%' OR direccion_entrega LIKE '%$busqueda%' OR total LIKE '%$busqueda%')";
	$resultActivos = mysqli_query($enlace, $queryActivos);

	// Verificar si se produjo un error en la consulta
	if (!$resultActivos) {
		$error = mysqli_error($enlace);
		$response = array("error" => $error);
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		exit;
	}

	while ($row = mysqli_fetch_assoc($resultActivos)) {
		$pedido = array(
			"id" => $row['id_pedido'],
			"total" => $row['total'],
			"estado" => $row['estado'],
			"fecha" => $row['fecha'],
			"hora" => $row['hora'],
			"direccion" => $row['direccion_entrega'],
			"metodo_pago" => $row['metodo_pago']
		);
		$response['activos'][] = $pedido;
	}

	// Consulta para obtener los pedidos finalizados que coinciden con la búsqueda
	$queryFinalizados = "SELECT * FROM Pedido WHERE estado IN ('Entregado', 'Cancelado') AND (fecha LIKE '%$busqueda%' OR estado LIKE '%$busqueda%' OR id_pedido LIKE '%$busqueda%' OR id_usuario LIKE '%$busqueda%' OR metodo_pago LIKE '%$busqueda%' OR direccion_entrega LIKE '%$busqueda%' OR total LIKE '%$busqueda%')";
	$resultFinalizados = mysqli_query($enlace, $queryFinalizados);

	// Verificar si se produjo un error en la consulta
	if (!$resultFinalizados) {
		$error = mysqli_error($enlace);
		$response = array("error" => $error);
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		exit;
	}

	while ($row = mysqli_fetch_assoc($resultFinalizados)) {
		$pedido = array(
			"id" => $row['id_pedido'],
			"total" => $row['total'],
			"estado" => $row['estado'],
			"fecha" => $row['fecha'],
			"hora" => $row['hora'],
			"direccion" => $row['direccion_entrega'],
			"metodo_pago" => $row['metodo_pago']
		);

		$response['finalizados'][] = $pedido;
	}

	// Verificar si no hay coincidencias en las búsquedas
	if (empty($response['activos']) && empty($response['finalizados'])) {
		$response = array("message" => "No se encontraron resultados para la búsqueda.");
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		exit;
	}

	echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
