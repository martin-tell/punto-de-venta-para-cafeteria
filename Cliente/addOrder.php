<?php
	session_start();
	$enlace = mysqli_connect("localhost", "root", "");
	mysqli_select_db($enlace, "cafeteria");
	$id_usuario = $_SESSION['id'];
	$id_producto = $_POST['id'];
	$name = $_POST['nombre'];
	$price = $_POST['precio'];
	$quant = $_POST['cantidad'];

	$response = array("new_order" => false, "quantity_added" => false, "product_added" => false);

	// Verificar si ya existe un pedido en estado "agregando productos" para el usuario actual
	$query = "SELECT id_pedido FROM Pedido WHERE id_usuario = $id_usuario AND estado = 'Agregando productos'";
	$result = mysqli_query($enlace, $query);

	if (mysqli_num_rows($result) > 0) {
		// Ya existe un pedido en estado "agregando productos" para el usuario, obtener su ID
		$row = mysqli_fetch_assoc($result);
		$id_pedido = $row['id_pedido'];
	} else {
		// No existe un pedido en estado "agregando productos" para el usuario, crear un nuevo pedido
		$query = "INSERT INTO Pedido (id_usuario, estado) VALUES ($id_usuario, 'Agregando productos')";
		mysqli_query($enlace, $query);
		$id_pedido = mysqli_insert_id($enlace); // Obtener el ID del nuevo pedido insertado
		$response['new_order'] = true;
	}

	// Verificar si el producto ya existe en la orden del usuario
	$query = "SELECT id_producto, cantidad FROM ProductoPedido WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
	$result = mysqli_query($enlace, $query);

	if (mysqli_num_rows($result) > 0) {
		// El producto ya existe en la orden del usuario, sumar las cantidades
		$row = mysqli_fetch_assoc($result);
		$cantidad_existente = $row['cantidad'];
		$cantidad_total = $cantidad_existente + $quant;

		// Actualizar la cantidad del producto en la orden del usuario
		$query = "UPDATE ProductoPedido SET cantidad = $cantidad_total WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
		mysqli_query($enlace, $query);
		$response['quantity_added'] = true;
	} else {
		// El producto no existe en la orden del usuario, insertarlo como un nuevo producto en la orden
		$query = "INSERT INTO ProductoPedido (id_pedido, id_producto, cantidad, precio_unitario) VALUES ($id_pedido, $id_producto, $quant, $price)";
		mysqli_query($enlace, $query);
		$response['product_added'] = true;
	}
	
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
