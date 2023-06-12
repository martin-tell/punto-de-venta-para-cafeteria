<?php
	session_start();
	$enlace = mysqli_connect("localhost", "root", "");
	mysqli_select_db($enlace, "cafeteria");
	$id_usuario = $_SESSION['id'];
	$street = $_POST['street'];
	$address_number = $_POST['address_number'];
	$neighborhood = $_POST['neighborhood'];
	$postal_code = (isset($_POST['postal_code']) ? $_POST['postal_code'] : '');
	$payment_method = $_POST['paymentMethod'];
	$response = array("order" => true, "command" => false);
	// Obtener el ID del pedido en estado 'agregando productos' para el usuario actual
	$query = "SELECT id_pedido FROM Pedido WHERE id_usuario = $id_usuario AND estado = 'Agregando productos'";
	$result = mysqli_query($enlace, $query);
	
	if (mysqli_num_rows($result) > 0) {
	  // Obtener el ID del pedido
	  $row = mysqli_fetch_assoc($result);
	  $id_pedido = $row['id_pedido'];

	  // Obtener la fecha y hora actual
	  $fecha = date('Y-m-d');
	  $hora = date('H:i:s');

	  // Calcular el total del pedido
	  $query = "SELECT SUM(pp.cantidad * pp.precio_unitario) AS total FROM ProductoPedido pp WHERE pp.id_pedido = $id_pedido";
	  $result = mysqli_query($enlace, $query);
	  $row = mysqli_fetch_assoc($result);
	  $total = $row['total'];

	  // Actualizar el pedido con los nuevos valores
	  $query = "UPDATE Pedido SET fecha = '$fecha', hora = '$hora', estado = 'En espera', metodo_pago = '$payment_method', total = $total, direccion_entrega = 'Calle $street #$address_number, $neighborhood, $postal_code' WHERE id_pedido = $id_pedido";
	  $result = mysqli_query($enlace, $query);
	  if ($result) {
		  $response['command'] = true;
	  } else {
	      $response['command'] = false;
	  }
	} else {
		$response['order'] = false;
	}
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
