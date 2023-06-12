<?php
    $enlace = mysqli_connect("localhost","root","");
    mysqli_select_db($enlace, "cafeteria");
	$busqueda = isset($_POST['busqueda']) ? mysqli_real_escape_string($enlace, $_POST['busqueda']) : '';
    $consulta = mysqli_query($enlace, "select * from usuario where nombre_de_pila like '%$busqueda%' or nombre_usuario like '%$busqueda%' or correo_electronico like '%$busqueda%' or rol like '%$busqueda%' or id_usuario like '%$busqueda%'");
	$filas = '';
	if(mysqli_num_rows($consulta) != 0 and $busqueda != ''){
		$usuarios = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
		foreach ($usuarios as $u){
			$filas .= '<tr>';
			$filas .= '    <th scope="row">'.$u['id_usuario'].'</th>';
			$filas .= '    <td>'.$u['nombre_de_pila'].'</td>';
			$filas .= '    <td>'.$u['nombre_usuario'].'</td>';
			$filas .= '    <td>'.$u['correo_electronico'].'</td>';
			$filas .= '    <td>'.$u['rol'].'</td>';
			$filas .= '    <td class="text-center">';
			$filas .= '        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actualizar" id="btn-actualizar">';
			$filas .= '            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">';
			$filas .= '                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>';
			$filas .= '            </svg>';
			$filas .= '        </button>';
			$filas .= '    </td>';
			$filas .= '    <td class="text-center">';
			$filas .= '        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminar" id="btn-eliminar">';
			$filas .= '            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">';
			$filas .= '                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>';
			$filas .= '            </svg>';
			$filas .= '        </button>';
			$filas .= '    </td>';
			$filas .= '</tr>';
		}
	}else{
		$filas .= "<tr>";
		$filas .= "<td colspan='7'>";
		$filas .= "No hay coincidencias";
		$filas .= "</td>";
		$filas .= "</tr>";	
	}
	
	$response = array('filas' => $filas);
	echo json_encode($response, JSON_UNESCAPED_UNICODE);	
?>