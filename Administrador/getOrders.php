<?php
	$enlace = mysqli_connect("localhost", "root", "");
	mysqli_select_db($enlace, "cafeteria");

	$response = array("activos" => array(), "finalizados" => array());

	// Consulta para obtener los pedidos activos
	$queryActivos = "SELECT * FROM Pedido WHERE estado IN ('En espera', 'En preparacion', 'En camino')";
	$resultActivos = mysqli_query($enlace, $queryActivos);

	if (!$resultActivos) {
	  $response['error'] = "Error en la consulta de pedidos activos: " . mysqli_error($enlace);
	} else {
	  while ($row = mysqli_fetch_assoc($resultActivos)) {
		$pedido = array(
		  "id_pedido" => $row['id_pedido'],
		  "fecha" => $row['fecha'],
		  "hora" => $row['hora'],
		  "total" => $row['total'],
		  "estado" => $row['estado'],
		  "direccion" => $row['direccion_entrega'],
		  "metodo_pago" => $row['metodo_pago']
		);
		$response['activos'][] = $pedido;
	  }
	}

	// Consulta para obtener los pedidos finalizados
	$queryFinalizados = "SELECT * FROM Pedido WHERE estado IN ('Entregado', 'Cancelado')";
	$resultFinalizados = mysqli_query($enlace, $queryFinalizados);

	if (!$resultFinalizados) {
	  $response['error'] = "Error en la consulta de pedidos finalizados: " . mysqli_error($enlace);
	} else {
	  while ($row = mysqli_fetch_assoc($resultFinalizados)) {
		$pedido = array(
		  "id_pedido" => $row['id_pedido'],
		  "fecha" => $row['fecha'],
		  "hora" => $row['hora'],
		  "total" => $row['total'],
		  "estado" => $row['estado'],
		  "direccion" => $row['direccion_entrega'],
		  "metodo_pago" => $row['metodo_pago']
		);

		$response['finalizados'][] = $pedido;
	  }
	}

	echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>