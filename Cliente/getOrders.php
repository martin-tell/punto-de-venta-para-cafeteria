<?php
	session_start();
	$enlace = mysqli_connect("localhost", "root", "");
	mysqli_select_db($enlace, "cafeteria");
	$id_usuario = $_SESSION['id'];

	// Consulta para obtener los pedidos en estados 'En espera', 'En preparación' y 'En camino'
	$query1 = "SELECT * FROM Pedido WHERE id_usuario = $id_usuario AND estado IN ('En espera', 'En preparación', 'En camino')";
	$result1 = mysqli_query($enlace, $query1);
	$pedidosEnProceso = mysqli_fetch_all($result1, MYSQLI_ASSOC);

	// Consulta para obtener los pedidos en estados 'Entregado' y 'Cancelado'
	$query2 = "SELECT * FROM Pedido WHERE id_usuario = $id_usuario AND estado IN ('Entregado', 'Cancelado')";
	$result2 = mysqli_query($enlace, $query2);
	$pedidosFinalizados = mysqli_fetch_all($result2, MYSQLI_ASSOC);

	$response = array("activos" => [], "finalizados" => []);

	// Almacenar los resultados de las consultas en el arreglo de respuesta
	foreach ($pedidosEnProceso as $pedido) {
		$pedidos_proceso = array();
		$pedidos_proceso[] = $pedido['id_pedido'];
		$pedidos_proceso[] = $pedido['fecha'];
		$pedidos_proceso[] = $pedido['hora'];
		$pedidos_proceso[] = $pedido['total'];
		$pedidos_proceso[] = $pedido['direccion_entrega'];
		$pedidos_proceso[] = $pedido['metodo_pago'];
		$pedidos_proceso[] = $pedido['estado'];
		$response['activos'][] = $pedidos_proceso;
	}

	foreach ($pedidosFinalizados as $pedido) {
		$pedidos_finalizados = array();
		$pedidos_finalizados[] = $pedido['id_pedido'];
		$pedidos_finalizados[] = $pedido['fecha'];
		$pedidos_finalizados[] = $pedido['hora'];
		$pedidos_finalizados[] = $pedido['total'];
		$pedidos_finalizados[] = $pedido['direccion_entrega'];
		$pedidos_finalizados[] = $pedido['metodo_pago'];
		$pedidos_finalizados[] = $pedido['estado'];
		$response['finalizados'][] = $pedidos_finalizados;
	}
	
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>

