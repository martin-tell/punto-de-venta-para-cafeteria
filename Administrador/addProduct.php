<?php
	$enlace = mysqli_connect("localhost","root","");
    mysqli_select_db($enlace, "cafeteria");
	$name = mysqli_real_escape_string($enlace, $_POST['name']);
	$desc = mysqli_real_escape_string($enlace, $_POST['desc']);
	$price = mysqli_real_escape_string($enlace, $_POST['price']);
	$img = $_FILES['imagen']['name'];
	$type = mysqli_real_escape_string($enlace, $_POST['type']);
	$avail = mysqli_real_escape_string($enlace, $_POST['avail']);
	
	$queryName = "SELECT * FROM producto WHERE nombre_producto = '$name'";
	$resultName = mysqli_query($enlace, $queryName);
	$queryImg = "SELECT * FROM producto WHERE imagen = '$img'";
	$resultImg = mysqli_query($enlace, $queryImg);
	$existing_data = array('img' => false, 'add' => false, 'query'=> false,'not_img' => false, 'file_exist' => false, 'img_size' => false, 'img_type' => false, 'img_error' => false, 'name' => false);
	if (mysqli_num_rows($resultImg) > 0) {	
		$existing_data['img'] =  true;
	}
	if (mysqli_num_rows($resultName) > 0) {	
		$existing_data['name'] =  true;
	}
	if(!$existing_data['img'] and !$existing_data['name']){
		$folder = "../imagenes_productos/";
		$image = $folder . basename($img);
		$is_img = getimagesize($_FILES['imagen']['tmp_name']);
		$type_image = strtolower(pathinfo($image,PATHINFO_EXTENSION));
		if($is_img === false) {
			$existing_data['not_image'] = true;
		}
		if(file_exists($image)) {
			$existing_data['file_exist'] = true;
		}
		if($_FILES['imagen']['size'] > 500000) {
			$existing_data['img_size'] = true;
		}
		if($type_image != "jpg" && $type_image != "png" && $type_image != "jpeg") {
			$existing_data['img_type'] = true;
		}
		if(!move_uploaded_file($_FILES['imagen']['tmp_name'], $image)) {
			$existing_data['img_error'] = true;
		}
		if(!$existing_data['img'] && !$existing_data['not_img'] && !$existing_data['file_exist'] && !$existing_data['img_size'] && !$existing_data['img_type'] && !$existing_data['img_error']){
			$query = "INSERT INTO Producto (nombre_producto, precio, descripcion, categoria, imagen, disponibilidad) VALUES ('$name', $price, '$desc', '$type', '$img', $avail)";
			$result = mysqli_query($enlace, $query);
			if($result){
				$existing_data['query'] = true;
				if(mysqli_affected_rows($enlace) > 0){
					$existing_data['add'] =  true;
				}
			}
		}
	}
	echo json_encode($existing_data);
?>