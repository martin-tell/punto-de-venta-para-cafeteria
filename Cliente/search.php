<?php
    $enlace = mysqli_connect("localhost","root","");
    mysqli_select_db($enlace, "cafeteria");
	$busqueda = isset($_POST['busqueda']) ? mysqli_real_escape_string($enlace, $_POST['busqueda']) : '';
    $consulta = mysqli_query($enlace, "select * from producto where nombre_producto like '%$busqueda%'");
	$tarjetas = '';
	$paginacion = '';
	if(mysqli_num_rows($consulta) != 0 and $busqueda != ''){
		$productos = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
		$rejilla = array_chunk($productos, 4);
		foreach ($rejilla as $fila){
			$tarjetas .= "<div class='row'>";
			foreach ($fila as $elemento){
				$tarjetas .= "<div class='col-md-3 mb-4'>";
				$tarjetas .= "<div class='card h-100'>";
				$tarjetas .= "<img src='../imagenes_productos/" . $elemento['imagen'] . "' class='card-img-top'>";
				$tarjetas .= "<div class='card-body d-flex flex-column'>";
				$tarjetas .= "<h5 class='card-title'>".$elemento['nombre_producto']."</h5>";
				$tarjetas .= "<p class='card-text'>".$elemento['descripcion']."</p>";
				$tarjetas .= "<h5 class='mt-auto'>Precio <span class='badge bg-secondary'>".$elemento['precio']."</span></h5>";
				$tarjetas .= "</div>";
				$tarjetas .= "<div class='card-footer'>";
				$tarjetas .= "<div class='d-flex justify-content-around'>";
				$tarjetas .= "<input type='number' class='form-control w-50 w-lg-25' placeholder='Cantidad' disabled>";
				$tarjetas .= "<button class='btn btn-primary' disabled>Agregar</button>";
				$tarjetas .= "</div>";
				$tarjetas .= "</div>";
				$tarjetas .= "</div>";
				$tarjetas .= "</div>";
			}
			$tarjetas .= "</div>";
		}
		$paginacion .= "<li class='page-item'> <a href='#' class='page-link'>1</a></li>";
	}else{
		$tarjetas .= "<p>No hay coincidencias</p>";
		$paginacion .= "<li class='page-item'> <a href='menu.php?pagina=$1' class='page-link'>1</a></li>";	
	}
	
	$response = array('tarjetas' => $tarjetas,'paginacion' => $paginacion);
	echo json_encode($response, JSON_UNESCAPED_UNICODE);	
?>