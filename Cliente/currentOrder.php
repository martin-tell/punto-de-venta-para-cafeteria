<?php
	session_start();
	$enlace = mysqli_connect("localhost", "root", "");
	mysqli_select_db($enlace, "cafeteria");
	$id_usuario = $_SESSION['id'];

	// Obtener el ID del pedido en estado 'agregando productos' para el usuario actual
	$query = "SELECT id_pedido FROM Pedido WHERE id_usuario = $id_usuario AND estado = 'Agregando productos'";
	$result = mysqli_query($enlace, $query);

	if (mysqli_num_rows($result) > 0) {
	  // Obtener el ID del pedido
	  $row = mysqli_fetch_assoc($result);
	  $id_pedido = $row['id_pedido'];

	  // Obtener los productos y sus detalles relacionados con el pedido
	  $query = "SELECT pp.id_producto_pedido, pp.id_producto, pp.cantidad, pp.precio_unitario, p.nombre_producto FROM ProductoPedido pp
				INNER JOIN Producto p ON pp.id_producto = p.id_producto
				WHERE pp.id_pedido = $id_pedido";
	  $result = mysqli_query($enlace, $query);

	  $productos = array();
	  $total = 0;
	  $num_productos = mysqli_num_rows($result); // Número de productos en la orden

	  while ($row = mysqli_fetch_assoc($result)) {
		$id_producto_pedido = $row['id_producto_pedido'];
		$id_producto = $row['id_producto'];
		$cantidad = $row['cantidad'];
		$precio_unitario = $row['precio_unitario'];
		$nombre_producto = $row['nombre_producto'];

		// Calcular el subtotal del producto (cantidad * precio unitario)
		$subtotal = $cantidad * $precio_unitario;
		$total += $subtotal;

		// Agregar el producto y sus detalles al array de productos
		$productos[] = array(
		  'id_producto_pedido' => $id_producto_pedido,
		  'id_producto' => $id_producto,
		  'nombre_producto' => $nombre_producto,
		  'cantidad' => $cantidad,
		  'precio_unitario' => $precio_unitario,
		  'subtotal' => $subtotal
		);
	  }

	  // Actualizar el total y el número de productos del pedido en la base de datos
	  $query = "UPDATE Pedido SET total = $total, num_productos = $num_productos WHERE id_pedido = $id_pedido";
	  mysqli_query($enlace, $query);

	  // Devolver los productos, el total y el número de productos como respuesta
	  $response = array(
		'productos' => $productos,
		'total' => $total,
		'num_productos' => $num_productos,
		'order' => true
	  );

	  echo json_encode($response, JSON_UNESCAPED_UNICODE);
	} else {
	  $response = array('order' => false);
	  echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}
?>
