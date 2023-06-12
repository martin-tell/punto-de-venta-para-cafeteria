<?php
    $limite = 12;
    $pagina = (isset($_GET['pagina']) && !($_GET['pagina'] < 1)) ? $_GET['pagina'] : 1;
    $inicio = ($pagina - 1) * $limite;
    $enlace = mysqli_connect("localhost","root","");
    mysqli_select_db($enlace, "cafeteria");
    $consulta_parcial = mysqli_query($enlace, "select * from producto limit $inicio, $limite");
	$filas = mysqli_num_rows($consulta_parcial);
	$tarjetas = "";
	$paginacion = "";
	if($filas > 0){
		$productos = mysqli_fetch_all($consulta_parcial, MYSQLI_ASSOC);
		$consulta_cantidad = mysqli_query($enlace, "select count(id_producto) as id from producto");
		$cantidad_productos = mysqli_fetch_all($consulta_cantidad, MYSQLI_ASSOC);
		$total = $cantidad_productos[0]['id'];
		$paginas = ceil($total / $limite);
		$anterior = $pagina-1;
		$siguiente = $pagina+1;
		$rejilla = array_chunk($productos, 4);
		foreach ($rejilla as $fila){
			$tarjetas .= "<div class='row'>";
			foreach ($fila as $elemento){
				$tarjetas .= "<div class='col-md-3 mb-4'>";
				$tarjetas .= "<div class='card h-100'>";
				$tarjetas .= "<img src='imagenes_productos/" . $elemento['imagen'] . "' class='card-img-top'>";
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
		$paginacion .= "<li class='page-item'> <a href='#' class='page-link' onclick='cargar_menu($anterior)'> <span aria-hidden='true'> &laquo; Anterior </span> </a> </li>";
		for($i=1; $i<=$paginas; $i++)
                $paginacion .= "<li class='page-item'> <a href='#' class='page-link' onclick='cargar_menu($i)'>".$i."</a> </li>";
		$paginacion .= "<li class='page-item'> <a href='#' class='page-link' onclick='cargar_menu($siguiente)'> <span aria-hidden='true'> Siguiente &raquo; </span> </a> </li>";
	}else{
		$tarjetas .= "<p>No hay productos por el momento </p>";
		$paginacion .= "<li class='page-item'> <a href='#' class='page-link' onclick='cargar_menu(1)'>1</a></li>";	
	}
	
	$response = array('tarjetas' => $tarjetas,'paginacion' => $paginacion);
	echo json_encode($response, JSON_UNESCAPED_UNICODE);	
?>
