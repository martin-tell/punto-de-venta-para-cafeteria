function cargar_productos(){
	let tabla = $("#tabla");
	if (window.location.pathname.includes("productos.php")) {
		$.ajax({
			url: 'allProducts.php',
			dataType: "json"
		})
		.done(function(respuesta){
			tabla.html(respuesta.filas);
		})
		.fail(function(resp){
			console.log(resp.responseText);
		})
		.always(function(){
			console.log("complete");
		});
	}
}

document.addEventListener("DOMContentLoaded", () => {
	if (document.URL.includes("productos.php")) {
		cargar_productos();
	}
})

function buscar_producto() {
	let input = $("#busqueda").val();
	let tabla = $("#tabla");
	let url = "searchProducts.php";
	let formData = new FormData();
	formData.append('busqueda', input);
	
	if (window.location.pathname.includes("productos.php")) {
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function() {

			},
			success: function(data) {
				tabla.html(data.filas);
			},
			error: function(err) {
				console.log(err);
			}
		});
	}
}

function cargar_usuarios(){
	let tabla = $("#tabla");
	$.ajax({
		url: 'allUsers.php',
		dataType: "json"
	})
	.done(function(respuesta){
		tabla.html(respuesta.filas);
	})
	.fail(function(resp){
		console.log(resp.responseText);
	})
	.always(function(){
		console.log("complete");
	});
}

document.addEventListener("DOMContentLoaded", () => {
	if (document.URL.includes("usuarios.php")) {
		cargar_usuarios();
	}
})

function buscar_usuarios() {
	let input = $("#busqueda").val();
	let tabla = $("#tabla");
	let url = "searchUsers.php";
	let formData = new FormData();
	formData.append('busqueda', input);
	
	if (window.location.pathname.includes("usuarios.php")) {
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function() {

			},
			success: function(data) {
				tabla.html(data.filas);
			},
			error: function(err) {
				console.log(err);
			}
		});
	}
}

let tabla;

document.addEventListener("DOMContentLoaded", () => {
	if (document.URL.includes("productos.php")) {
		tabla = $("#contenedor-tabla").dataTable({
			searching: false,
			paging: false,
			info: false
		});
	}
})

$(document).on('click', '#btn-actualizar', function (){
	if (window.location.pathname.includes("productos.php")) {
		let row = $(this).closest("tr");
		let id = row.find("th").map(function() {
			return $(this).text();
		}).get();
		let data = row.find("td").map(function() {
			return $(this).text();
		}).get();
		console.log(data);
		modal = $("#form-actualizar")
		modal.find("#nombre").val(data[0]);
		modal.find("#descripcion").val(data[1]);
		modal.find("#precio").val(data[3].replace(/\$/g, ""));
		modal.find("#categoria").val(data[2]);
		modal.find("#disponibilidad").val((data[5] == "Sí") ? 1 : 0);
		modal.find("#miniatura").attr("src", "../imagenes_productos/"+data[4]);
		modal.find("#id").val(id[0]);
		modal.find("#old_name").val(data[4]);
	}
});

$(document).on('click', '#boton-actualizar', function(event) {
    event.preventDefault();
	let formData = new FormData(document.getElementById('form-update'));
    if (window.location.pathname.includes("productos.php")) {
        $.ajax({
            url: 'updateProduct.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#boton-actualizar').text('Actualizando...');
            }
        })
        .done(function(respuesta) {
            if(respuesta.query) {
				cargar_productos();
				mensaje = "No ha habido cambios";
				if(respuesta.update) {
					mensaje = "Se ha actualizado el producto correctamente";
				}
                setTimeout(function() {
                    alert(mensaje);
                }, 250);
            } else {
				console.log(respuesta);
				error = $("#img_error");
				mensaje_error = false;
                if(respuesta.img) {
					error.text('Cambie el nombre de la imagen');
					mensaje_error = true;
                }
				if(respuesta.update){
					error.text('Hubo un error inesperado');
					mensaje_error = true;
				}
				if(respuesta.not_img){
					error.text('El archivo no es una imagen');
					mensaje_error = true;
				}
				if(respuesta.file_exist){
					error.text('La imagen ya existe en el servidor. Use otra');
					mensaje_error = true;
				}
				if(respuesta.img_size){
					error.text('La imagen es muy grande');
					mensaje_error = true;
				}
				if(respuesta.img_type){
					error.text('El tipo de imagen no se aceptada');		
					mensaje_error = true;
				}				
				if(respuesta.img_error){
					error.text('No se pudo guardar la imagen. Intentelo más tarde');	
					mensaje_error = true;
				}
				if(mensaje_error){
					$('#img_error').slideDown('slow');
                    setTimeout(function() {
                        $('#img_error').slideUp('slow');
                    }, 3000);	
				}
            }
			$('#boton-actualizar').text('Actualizar');
        })
        .fail(function(jqXHR, textStatus) {
            console.log("Estado de la solicitud: " + textStatus);
            console.log("Mensaje de error: " + jqXHR.responseText);
        })
        .always(function() {
            console.log("complete");
        });
    }
});

$(document).on('click', '#btn-eliminar', function(event) {
	event.preventDefault();
	if (window.location.pathname.includes("productos.php")) {
		let row = $(this).closest("tr");
		let id = row.find("th").map(function() {
			return $(this).text();
		}).get();
		let data = row.find("td").map(function() {
			return $(this).text();
		}).get();
		modal = $("#mensaje-eliminar")
		modal.text("Está seguro que quiere eliminar '"+data[0]+"'");
		form_del = $("#form-delete");
		form_del.find("#id").val(id[0]);
		form_del.find("#old_name").val(data[4]);
	}
});

$(document).on('click', '#boton-eliminar', function(event) {
    event.preventDefault();
	let formData = new FormData(document.getElementById("form-delete"));
	if (window.location.pathname.includes("productos.php")) {
		$.ajax({
			url: 'deleteProduct.php',
			type: 'POST',
			data: formData,
            contentType: false,
            processData: false
		})
		.done(function(response) {
				mensaje_error = "Se ha eliminado el producto correctamente";
                if(response.file_exist) {
					mensaje_error = "El archivo relacionado a la imagen del producto no se ha encontrado, no se eliminarà";
                }
				if(response.file_deleted){
					mensaje_error = "No se ha podido eliminar el archivo relacionado a la imagen del producto";
				}
				if(response.delete_query){
					mensaje_error = "El nombre del archivo no se ha podido eliminar de la base de datos";
				}
				setTimeout(function() {
                    alert(mensaje_error);
                }, 250)
				cargar_productos();
				$("#eliminar").modal('hide');
		})
		.fail(function(jqXHR, textStatus, errorThrown) {
			console.error(textStatus, errorThrown);
		})
		.always(function(){
			console.log("complete");
		});
	}
});

$(document).on('click', '#cerrar_sesion', function(event){
	event.preventDefault();
	$.ajax({
		url: 'logOut.php',
		type: 'POST'
	})
	.done(function(response) {
		window.location.href = '../index.php';
	})
	.fail(function(xhr, status, error) {
		console.error(error);
	})
	.always(function(){
		console.log("complete");
	});
});

function cargar_pedidos(){
	let activos = $("#activos");
	let finalizados = $("#finalizados");
	let act = '';
	let prev = '';
	let err = '';
	$.ajax({
		url: 'getOrders.php',
		dataType: 'json'
	})
	.done(function(response){
		if(response.activos.length !== 0){
			for (let i = 0; i < response.activos.length; i++) {
				act += '<ul class="list-group mb-3" id="contenedor-pedido">';              
				act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				act += '    <h6 class="my-0">ID del Pedido</h6>';
				act += '    <span id="id_pedido" class="text-body-secondary" name="id_pedido">'+response.activos[i]['id_pedido']+'</span>';
				act += '</li>';
				act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				act += '    <h6 class="my-0">Monto a pagar</h6>';
				act += '    <span class="text-body-secondary">'+response.activos[i]['total']+'</span>';
				act += '</li>';
				act += '<li class="list-group-item d-flex justify-content-between lh-sm">';				
				act += '    <h6 class="my-0">Estado del pedido</h6>';
				act += '	<div class = "d-flex">';
				act += '		<select id="estado" class="form-select" aria-label="Default select example" style="width: 120px; height: 35px" name="estado">';
				act += '   			<option value="En espera"'+((response.activos[i]['estado'] === 'En espera') ? 'selected' : '')+'>En espera</option>';
				act += '			<option value="En preparación"'+((response.activos[i]['estado'] === 'En preparación') ? 'selected' : '')+'>En preparación</option>';
				act += '			<option value="En camino"'+((response.activos[i]['estado'] === 'En camino') ? 'selected' : '')+'>En camino</option>';
				act += '			<option value="Entregado"'+((response.activos[i]['estado'] === 'Entregado') ? 'selected' : '')+'>Entregado</option>';
				act += '			<option value="Cancelado"'+((response.activos[i]['estado'] === 'Cancelado') ? 'selected' : '')+'>Cancelar</option>';
				act += '		</select>';
				act += '		<button id="cambiar-estado" class="ms-2 btn btn-primary" style="height: 35px"> Cambiar Estado </button>';
				act += '	</div>';
				act += '</li>';
				act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				act += '    <h6 class="my-0">Fecha y hora</h6>';
				act += '    <span class="text-body-secondary">'+response.activos[i]['fecha']+' a las '+response.activos[i]['hora']+'</span>';
				act += '</li>';
				act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				act += '    <h6 class="my-0">Dirección de envio</h6>';
				act += '    <span class="text-body-secondary">'+response.activos[i]['direccion']+'</span>';
				act += '</li>';
				act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				act += '    <h6 class="my-0">Método de pago</h6>';
				act += '    <span class="text-body-secondary">'+response.activos[i]['metodo_pago']+'</span>';
				act += '</li>';
				act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				act += '    <span></span>';
				act += '    <a data-bs-toggle="modal" data-bs-target="#detalles" href="#">Más Detalles</a>';
				act += '</li>';					
				act += '</ul>';
			}
			activos.html(act);
		}else{
			act += '<ul  class="list-group mb-3">';              
			act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
			act += '    <div> <p> No hay pedidos por el momento </p> </div>';
			act += '</li>';					
			act += '</ul>';
			activos.html(act);			
		}
		if(response.finalizados.length !== 0){
			for (let i = 0; i < response.finalizados.length; i++) {
				prev += '<ul  class="list-group mb-3">';              
				prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				prev += '    <h6 class="my-0">ID del Pedido</h6>';
				prev += '    <span class="text-body-secondary">'+response.finalizados[i]['id_pedido']+'</span>';
				prev += '</li>';
				prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				prev += '    <h6 class="my-0">Monto a pagar</h6>';
				prev += '    <span class="text-body-secondary">'+response.finalizados[i]['total']+'</span>';
				prev += '</li>';
				prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				prev += '    <h6 class="my-0">Estado del pedido</h6>';
				prev += '    <span class="text-body-secondary">'+response.finalizados[i]['estado']+'</span>';
				prev += '</li>';
				prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				prev += '    <h6 class="my-0">Fecha y hora</h6>';
				prev += '    <span class="text-body-secondary">'+response.finalizados[i]['fecha']+' a las '+response.finalizados[i]['hora']+'</span>';
				prev += '</li>';
				prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				prev += '    <h6 class="my-0">Dirección de envio</h6>';
				prev += '    <span class="text-body-secondary">'+response.finalizados[i]['direccion']+'</span>';
				prev += '</li>';
				prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				prev += '    <h6 class="my-0">Método de pago</h6>';
				prev += '    <span class="text-body-secondary">'+response.finalizados[i]['metodo_pago']+'</span>';
				prev += '</li>';
				prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				prev += '    <span></span>';
				prev += '    <a data-bs-toggle="modal" data-bs-target="#detalles" href="#">Más Detalles</a>';
				prev += '</li>';					
				prev += '</ul>';
			}
			finalizados.html(prev);
		}else{
			prev += '<ul  class="list-group mb-3">';              
			prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
			prev += '    <div> <p> No hay pedidos por el momento </p> </div>';
			prev += '</li>';					
			prev += '</ul>';
			prev.html(act);
		}
		if('error' in response){
			err += '<ul  class="list-group mb-3">';              
			err += '<li class="list-group-item d-flex justify-content-between lh-sm">';
			err += '    <div> <p> Ha ocurrido un error intentelo màs tarde. </p> </div>';
			err += '</li>';					
			err += '</ul>';
			activos.html(err);
			finalizados.html(err);
		}
	})
	.fail(function(xhr, status, error){
		console.error(error);
	})
	.always(function(){
		console.log('complete');;
	});
}

document.addEventListener("DOMContentLoaded", () => {
	if (document.URL.includes("pedidos.php")) {
		cargar_pedidos();
	}
})

$(document).on('click', '#cambiar-estado', function(event){
	let pedido = $(this).closest('#contenedor-pedido');
	let id = pedido.find('#id_pedido').text();
	let estado = pedido.find('#estado').val();
	
	if (window.location.pathname.includes("pedidos.php")) {
		$.ajax({
			url: 'changeState.php',
			type: 'POST',
			dataType: 'json',
			data:{
				id_pedido: id,
				estado: estado
			},
			beforeSend: function(){
				$('#cambiar-estado').text("Cambiando...");
			}
		})
		.done(function(response){
			console.log(response);
			if(response.success){
				setTimeout(function(){
					$('#cambiar-estado').text("Cambiar Estado");
					cargar_pedidos();
					alert(response.message);
				}, 500);
			}else{
				setTimeout(function(){
					$('#cambiar-estado').text("Cambiar Estado");
					cargar_pedidos();
					alert(response.message);
				}, 500);				
			}
		})
		.fail(function(resp){
			console.log(resp);
		})
		.always(function(){
			console.log("complete");
		});
	}
});

$(document).on("click","#buscar", function(){
	let input = $("#busqueda").val();
	let activos = $("#activos");
	let finalizados = $("#finalizados");
	let url = "searchOrders.php";
	let formData = new FormData();
	formData.append('busqueda', input);
	let act = "";
	let prev = "";
	let err = "";
	let mess = "";
	if (window.location.pathname.includes("pedidos.php")) {
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function() {

			},
			success: function(response) {
				if('activos' in response){
					if(response.activos.length !== 0){
						for (let i = 0; i < response.activos.length; i++) {
							act += '<ul class="list-group mb-3" id="contenedor-pedido">';              
							act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							act += '    <h6 class="my-0">ID del Pedido</h6>';
							act += '    <span id="id_pedido" class="text-body-secondary" name="id_pedido">'+response.activos[i]['id']+'</span>';
							act += '</li>';
							act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							act += '    <h6 class="my-0">Monto a pagar</h6>';
							act += '    <span class="text-body-secondary">'+response.activos[i]['total']+'</span>';
							act += '</li>';
							act += '<li class="list-group-item d-flex justify-content-between lh-sm">';				
							act += '    <h6 class="my-0">Estado del pedido</h6>';
							act += '	<div class = "d-flex">';
							act += '		<select id="estado" class="form-select" aria-label="Default select example" style="width: 120px; height: 35px" name="estado">';
							act += '   			<option value="En espera"'+((response.activos[i]['estado'] === 'En espera') ? 'selected' : '')+'>En espera</option>';
							act += '			<option value="En preparación"'+((response.activos[i]['estado'] === 'En preparación') ? 'selected' : '')+'>En preparación</option>';
							act += '			<option value="En camino"'+((response.activos[i]['estado'] === 'En camino') ? 'selected' : '')+'>En camino</option>';
							act += '			<option value="Entregado"'+((response.activos[i]['estado'] === 'Entregado') ? 'selected' : '')+'>Entregado</option>';
							act += '			<option value="Cancelado"'+((response.activos[i]['estado'] === 'Cancelado') ? 'selected' : '')+'>Cancelar</option>';
							act += '		</select>';
							act += '		<button id="cambiar-estado" class="ms-2 btn btn-primary" style="height: 35px"> Cambiar Estado </button>';
							act += '	</div>';
							act += '</li>';
							act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							act += '    <h6 class="my-0">Fecha y hora</h6>';
							act += '    <span class="text-body-secondary">'+response.activos[i]['fecha']+' a las '+response.activos[i]['hora']+'</span>';
							act += '</li>';
							act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							act += '    <h6 class="my-0">Dirección de envio</h6>';
							act += '    <span class="text-body-secondary">'+response.activos[i]['direccion']+'</span>';
							act += '</li>';
							act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							act += '    <h6 class="my-0">Método de pago</h6>';
							act += '    <span class="text-body-secondary">'+response.activos[i]['metodo_pago']+'</span>';
							act += '</li>';
							act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							act += '    <span></span>';
							act += '    <a data-bs-toggle="modal" data-bs-target="#detalles" href="#">Más Detalles</a>';
							act += '</li>';					
							act += '</ul>';
						}
						activos.html(act);
					}else{
						act += '<ul  class="list-group mb-3">';              
						act += '<li class="list-group-item d-flex justify-content-between lh-sm">';
						act += '    <div> <p> No hay coincidencias </p> </div>';
						act += '</li>';					
						act += '</ul>';
						activos.html(act);			
					}
				}
				if('finalizados' in response){
					if(response.finalizados.length !== 0){
						for (let i = 0; i < response.finalizados.length; i++) {
							prev += '<ul  class="list-group mb-3">';              
							prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							prev += '    <h6 class="my-0">ID del Pedido</h6>';
							prev += '    <span class="text-body-secondary">'+response.finalizados[i]['id']+'</span>';
							prev += '</li>';
							prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							prev += '    <h6 class="my-0">Monto a pagar</h6>';
							prev += '    <span class="text-body-secondary">'+response.finalizados[i]['total']+'</span>';
							prev += '</li>';
							prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							prev += '    <h6 class="my-0">Estado del pedido</h6>';
							prev += '    <span class="text-body-secondary">'+response.finalizados[i]['estado']+'</span>';
							prev += '</li>';
							prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							prev += '    <h6 class="my-0">Fecha y hora</h6>';
							prev += '    <span class="text-body-secondary">'+response.finalizados[i]['fecha']+' a las '+response.finalizados[i]['hora']+'</span>';
							prev += '</li>';
							prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							prev += '    <h6 class="my-0">Dirección de envio</h6>';
							prev += '    <span class="text-body-secondary">'+response.finalizados[i]['direccion']+'</span>';
							prev += '</li>';
							prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							prev += '    <h6 class="my-0">Método de pago</h6>';
							prev += '    <span class="text-body-secondary">'+response.finalizados[i]['metodo_pago']+'</span>';
							prev += '</li>';
							prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
							prev += '    <span></span>';
							prev += '    <a data-bs-toggle="modal" data-bs-target="#detalles" href="#">Más Detalles</a>';
							prev += '</li>';					
							prev += '</ul>';
						}
						finalizados.html(prev);
					}else{
						prev += '<ul  class="list-group mb-3">';              
						prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
						prev += '    <div> <p> No hay coincidencias  </p> </div>';
						prev += '</li>';					
						prev += '</ul>';
						finalizados.html(prev);
					}
				}
				if('error' in response){
					err += '<ul  class="list-group mb-3">';              
					err += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					err += '    <div> <p> Ha ocurrido un error intentelo màs tarde. </p> </div>';
					err += '</li>';					
					err += '</ul>';
					activos.html(err);
					finalizados.html(err);
				}
				if('message' in response){
					mess += '<ul  class="list-group mb-3">';              
					mess += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					mess += '    <div> <p> '+response['message']+' </p> </div>';
					mess += '</li>';					
					mess += '</ul>';
					activos.html(mess);
					finalizados.html(mess);
				}				
			},
			error: function(err) {
				console.log(err);
			}
		});
	}
});

$(document).on("click","#reestablecer", function(){
	if (window.location.pathname.includes("pedidos.php")) {
		cargar_pedidos();
	}
});

$(document).on('click', '#boton-agregar', function(event) {
    event.preventDefault();
	let formData = new FormData(document.getElementById('form-addProduct'));
    if (window.location.pathname.includes("productos.php")) {
        $.ajax({
            url: 'addProduct.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#boton-agregar').text('Agregando...');
            }
        })
        .done(function(respuesta) {
            if(respuesta.query) {
				mensaje = "Error. No se ha podido agregar el producto";
				if(respuesta.add) {
					cargar_productos();
					mensaje = "Se ha agregado el producto correctamente";
					$('#form-addProduct')[0].reset();
					$('#miniaturaContainer').hide();
				}
                setTimeout(function() {
                    alert(mensaje);
                }, 250);
            } else {
				error = $("#img_error");
				error_name = $("#name_error");
				mensaje_error = false;
				mensaje_error_name = false;
                if(respuesta.img) {
					error.text('Cambie el nombre de la imagen');
					mensaje_error = true;
                }
				if(respuesta.update){
					error.text('Hubo un error inesperado');
					mensaje_error = true;
				}
				if(respuesta.not_img){
					error.text('El archivo no es una imagen');
					mensaje_error = true;
				}
				if(respuesta.file_exist){
					error.text('La imagen ya existe en el servidor. Use otra');
					mensaje_error = true;
				}
				if(respuesta.img_size){
					error.text('La imagen es muy grande');
					mensaje_error = true;
				}
				if(respuesta.img_type){
					error.text('El tipo de imagen no se aceptada');		
					mensaje_error = true;
				}			
				if(respuesta.img_error){
					error.text('No se pudo guardar la imagen. Intentelo más tarde');	
					mensaje_error = true;
				}
				if(respuesta.name){
					mensaje_error_name = true;
				}
				if(mensaje_error){
					$('#img_error').slideDown('slow');
                    setTimeout(function() {
                        $('#img_error').slideUp('slow');
                    }, 3000);	
				}
				if(mensaje_error_name){
					$('#name_error').slideDown('slow');
                    setTimeout(function() {
                        $('#name_error').slideUp('slow');
                    }, 3000);	
				}
            }
			$('#boton-agregar').text('Agregar');
        })
        .fail(function(jqXHR, textStatus) {
            console.log("Estado de la solicitud: " + textStatus);
            console.log("Mensaje de error: " + jqXHR.responseText);
        })
        .always(function() {
            console.log("complete");
        });
    }
});

function mostrarMiniatura() {
	if (window.location.pathname.includes("productos.php")) {
		let fileInput = document.getElementById('imagenInput');
		let miniatura = document.getElementById('miniatura');
		let miniaturaContainer = document.getElementById('miniaturaContainer');
		// Verificar si se seleccionó un archivo
		if (fileInput.files && fileInput.files[0]) {
			let reader = new FileReader();
			reader.onload = function(e) {
				miniatura.src = e.target.result;
				miniaturaContainer.style.display = 'block'; // Mostrar el contenedor de la miniatura
			};
			reader.readAsDataURL(fileInput.files[0]); // Leer el archivo como URL de datos
		} else {
			miniatura.src = '#';
			miniaturaContainer.style.display = 'none'; // Ocultar el contenedor de la miniatura si no se selecciona ningún archivo
		}
	}
}

$(document).on('click', '#boton-registrar', function(event) {
    event.preventDefault();
	let formData = new FormData(document.getElementById('register-form'));
    if (window.location.pathname.includes("usuarios.php")) {
        $.ajax({
            url: 'addUser.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#boton-registar').text('Registrando...');
            }
        })
        .done(function(respuesta) {
            if(respuesta.query) {
				mensaje = "Error. No se ha podido registrar al usuario";
				if(respuesta.add) {
					cargar_usuarios();
					mensaje = "Se ha registrado al usuario correctamente";
					$('#register-form')[0].reset();
				}
                setTimeout(function() {
                    alert(mensaje);
                }, 250);
            } else {
				error_user = $("#user_error");
				error_mail = $("#mail_error");
				if(respuesta.user){
					$('#user_error').slideDown('slow');
                    setTimeout(function() {
                        $('#user_error').slideUp('slow');
                    }, 3000);	
				}
				if(respuesta.mail){
					$('#mail_error').slideDown('slow');
                    setTimeout(function() {
                        $('#mail_error').slideUp('slow');
                    }, 3000);	
				}
            }
			$('#boton-resgistar').text('Registrar');
        })
        .fail(function(jqXHR, textStatus) {
            console.log("Estado de la solicitud: " + textStatus);
            console.log("Mensaje de error: " + jqXHR.responseText);
        })
        .always(function() {
            console.log("complete");
        });
    }
})

$(document).on('click', '#btn-eliminar', function(event) {
	event.preventDefault();
	if (window.location.pathname.includes("usuarios.php")) {
		let row = $(this).closest("tr");
		let id = row.find("th").map(function() {
			return $(this).text();
		}).get();
		let data = row.find("td").map(function() {
			return $(this).text();
		}).get();
		modal = $("#mensaje-eliminar")
		modal.text("Está seguro que quiere eliminar a "+data[0]);
		form_del = $("#form-delete");
		form_del.find("#id").val(id[0]);
	}
});

$(document).on('click', '#boton-eliminar', function(event) {
    event.preventDefault();
	let formData = new FormData(document.getElementById("form-delete"));
	if (window.location.pathname.includes("usuarios.php")) {
		$.ajax({
			url: 'deleteUser.php',
			type: 'POST',
			data: formData,
            contentType: false,
            processData: false
		})
		.done(function(response) {
				mensaje_error = "Se ha eliminado al usuario correctamente";
				if(response.delete_query){
					mensaje_error = "Ha ocurrido un error. El usuario no ha podido eliminarse. Inténtelo màs tarde";
				}
				setTimeout(function() {
                    alert(mensaje_error);
                }, 250)
				cargar_usuarios();
				$("#eliminar").modal('hide');
		})
		.fail(function(jqXHR, textStatus, errorThrown) {
			console.error(textStatus, errorThrown);
		})
		.always(function(){
			console.log("complete");
		});
	}
});

$(document).on('click', '#btn-actualizar', function (){
	if (window.location.pathname.includes("usuarios.php")) {
		let row = $(this).closest("tr");
		let id = row.find("th").map(function() {
			return $(this).text();
		}).get();
		let data = row.find("td").map(function() {
			return $(this).text();
		}).get();
		modal = $("#form-actualizar")
		modal.find("#name_up").val(data[0]);
		modal.find("#user_up").val(data[1]);
		modal.find("#mail_up").val(data[2]);
		modal.find("#tipo_up").val(data[3]);
		modal.find("#oldName_up").val(data[1]);
		modal.find("#oldMail_up").val(data[2]);
		modal.find("#id_up").val(id[0]);
	}
});

$(document).on('click', '#boton-actualizar', function(event) {
    event.preventDefault();
	let formData = new FormData(document.getElementById('form-update'));
    if (window.location.pathname.includes("usuarios.php")) {
        $.ajax({
            url: 'updateUser.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#boton-actualizar').text('Actualizando...');
            }
        })
        .done(function(respuesta) {
			console.log(respuesta);
			mensaje = "";
            if(respuesta.update_user) {				
				mensaje += "Se ha actualizado el nombre de usuario\n";
            } else {
				if(respuesta.same_user) {
					mensaje += "No ha habido cambios en el nombre de usuario\n";
				}else{
					$('#userUp_error').slideDown('slow');
					setTimeout(function() {
						$('#userUp_error').slideUp('slow');
					}, 3000);	
				}
            }
            if(respuesta.update_mail) {
				mensaje += "Se ha actualizado el correo electrónico del usuario\n";
            } else {
				if(respuesta.same_mail) {
					mensaje += "No ha habido cambios en el correo del usuario\n";
				}else{
					$('#mailUp_error').slideDown('slow');
					setTimeout(function() {
						$('#mailUp_error').slideUp('slow');
					}, 5000);	
				}
            }
			if(respuesta.update_missing) {
				mensaje += "Se ha actualizado el nombre de pila y el rol del usuario";
            }
			cargar_usuarios();
			alert(mensaje);
			$('#boton-actualizar').text('Actualizar');
        })
        .fail(function(jqXHR, textStatus) {
            console.log("Estado de la solicitud: " + textStatus);
            console.log("Mensaje de error: " + jqXHR.responseText);
        })
        .always(function() {
            console.log("complete");
        });
    }
});