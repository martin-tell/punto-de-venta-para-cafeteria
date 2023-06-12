function cargar_menu(page) {
  let content = $("#contenido");
  let pagination = $("#paginas");
  let url = "dataSlice.php?pagina=" + page;
  $.ajax({
    url: url,
    type: "GET",
    dataType: "json",
    success: function(data) {
      content.html(data.tarjetas);
      pagination.html(data.paginacion);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error en la solicitud:", errorThrown);
    }
  });
}

document.addEventListener("DOMContentLoaded", () => {
	if (document.URL.includes("menu.php")) {
		cargar_menu(1);
	}
})

function buscar_producto() {
	let input = $("#busqueda").val();
	let content = $("#contenido");
	let pagination = $("#paginas");
	let url = "search.php";
	let formData = new FormData();
	formData.append('busqueda', input);
	
	if (window.location.pathname.includes("menu.php")) {
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
				content.html(data.tarjetas);
				pagination.html(data.paginacion);
			},
			error: function(err) {
				console.log(err);
			}
		});
	}
}

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

$(document).on('click', '#btn-agregar', function(event) {
  let card = $(this).closest('#tarjeta');
  let cantidad = card.find('#cantidad').val();
  let nombre = card.find('#nombre').text();
  let precio = card.find('#precio').text();
  let id = card.find('#id').text();
  let descripcion = card.find('#descripcion').text();

  if (window.location.pathname.includes("menu.php")) {
    let decision = confirm("¿Agregar " + cantidad + " de " + nombre + " a la orden?");
    if (decision) {
      $.ajax({
        url: 'addOrder.php',
        type: 'POST',
		dataType: 'json',
        data: {
          id: id,
          nombre: nombre,
          precio: precio,
          cantidad: cantidad
        }
      })
      .done(function(response) {
			mensaje = "";
			if(response.new_order){
				mensaje += "Se ha creado una nueva orden.\n";
			}
			if(response.quantity_added){
				mensaje += "Se ha añadido más cantidad del producto a la orden.\n";
			}	
			if(response.product_added){
				mensaje += "Se ha añadido más producto a la orden.\n";
			}
			alert(mensaje);
      })
      .fail(function(xhr, status, error) {
        console.error(error);
      })
      .always(function() {
        console.log("complete");
      });
    }
  }
});

function cargar_orden(){
	let orden = $("#order");
	let products = $("#num_products");
	let html_code = '';
	$.ajax({
		url: "currentOrder.php",
		dataType: 'json',
		success: function(data) {
			if(data.order){
				data.productos.forEach(function(producto){
					html_code += "<li class='list-group-item d-flex justify-content-between lh-sm'>";
					html_code += "	<div>";
					html_code += "		<h6 class='my-0'>"+producto.nombre_producto+"</h6>";
					html_code += "		<small class='text-body-secondary'>"+"Cantidad: "+producto.cantidad+" Precio Unitario: $"+producto.precio_unitario+"</small>";
					html_code += "	</div>`";
					html_code += "	<span class='text-body-secondary'>"+"$"+producto.subtotal.toFixed(2)+"</span>";
					html_code += "</li>";
				});
				html_code += "<li class='list-group-item d-flex justify-content-between'>";
				html_code += "	<span>Total (MXN)</span>";
				html_code += "	<strong id='total'>$"+data.total+"</strong>";
				html_code += "</li>";
				orden.html(html_code);
				products.html(data.num_productos);
			}else{
				orden.html("<li class='list-group-item d-flex justify-content-between'><div><span class='my-0'>No hay una orden</span></div><span>Total (MXN)</span><strong>0</strong></li>");
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
		  console.log("Error en la solicitud:", errorThrown);
		}
  });
}

document.addEventListener("DOMContentLoaded", () => {
	if (document.URL.includes("orden.php")) {
		cargar_orden();
	}
})

$(document).on('click', '#command', function(event) {
    event.preventDefault();
	let formData = new FormData(document.getElementById('address-payment'));
    if (window.location.pathname.includes("orden.php")) {
        $.ajax({
            url: 'command.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#command').text('Ordenando...');
            }
        })
        .done(function(respuesta){
			mensaje = "";
            if(respuesta.command) {
				mensaje = "Se ha realizado el pedido correctamente";
				window.location.href = "pedidos.php";
            } else {
				mensaje = "Error al realizar el pedido";
            }
			if(!respuesta.order){
				mensaje = "No se encontró un pedido actual";
			}
			$('#command').text('Realizar Pedido');
			alert(mensaje);
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

function cargar_pedidos(){
	let recientes = $("#recientes");
	let previos = $("#previos");
	let html_code = '';
	$.ajax({
		url: "getOrders.php",
		dataType: 'json',
		success: function(data) {
			let rec = '';
			if(data.activos.length !== 0){
				for (let i = 0; i < data.activos.length; i++) {
					rec += '<ul  class="list-group mb-3">';                
					rec += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					rec += '    <h6 class="my-0">ID del Pedido</h6>';
					rec += '    <span class="text-body-secondary">'+data.activos[i][0]+'</span>';
					rec += '</li>';
					rec += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					rec += '    <h6 class="my-0">Monto a pagar</h6>';
					rec += '    <span class="text-body-secondary">'+data.activos[i][3]+'</span>';
					rec += '</li>';
					rec += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					rec += '    <h6 class="my-0">Estado del pedido</h6>';
					rec += '    <span class="text-body-secondary">'+data.activos[i][6]+'</span>';
					rec += '</li>';
					rec += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					rec += '    <h6 class="my-0">Fecha y hora</h6>';
					rec += '    <span class="text-body-secondary">'+data.activos[i][1]+' a las '+data.activos[i][2]+'</span>';
					rec += '</li>';
					rec += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					rec += '    <h6 class="my-0">Dirección de envio</h6>';
					rec += '    <span class="text-body-secondary">'+data.activos[i][4]+'</span>';
					rec += '</li>';
					rec += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					rec += '    <h6 class="my-0">Método de pago</h6>';
					rec += '    <span class="text-body-secondary">'+data.activos[i][5]+'</span>';
					rec += '</li>';
					rec += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					rec += '    <span></span>';
					rec += '    <a data-bs-toggle="modal" data-bs-target="#detalles" href="#">Más Detalles</a>';
					rec += '</li>';
					rec += '</ul>';
				}
				recientes.html(rec);
			}else{
				rec += '<ul  class="list-group mb-3">';                
				rec += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				rec += '    <span></span>';
				rec += '    <h6 class="my-0">No hay registro de pedidos</h6>';
				rec += '</li>';
				rec += '</ul>';
				recientes.html(rec);
			}
			let prev = '';
			if(data.finalizados.length !== 0){
				for (let i = 0; i < data.finalizados.length; i++) {
					prev += '<ul  class="list-group mb-3">';              
					prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					prev += '    <h6 class="my-0">ID del Pedido</h6>';
					prev += '    <span class="text-body-secondary">'+data.finalizados[i][0]+'</span>';
					prev += '</li>';
					prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					prev += '    <h6 class="my-0">Monto a pagar</h6>';
					prev += '    <span class="text-body-secondary">'+data.finalizados[i][3]+'</span>';
					prev += '</li>';
					prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					prev += '    <h6 class="my-0">Estado del pedido</h6>';
					prev += '    <span class="text-body-secondary">'+data.finalizados[i][6]+'</span>';
					prev += '</li>';
					prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					prev += '    <h6 class="my-0">Fecha y hora</h6>';
					prev += '    <span class="text-body-secondary">'+data.finalizados[i][1]+' a las '+data.finalizados[i][2]+'</span>';
					prev += '</li>';
					prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					prev += '    <h6 class="my-0">Dirección de envio</h6>';
					prev += '    <span class="text-body-secondary">'+data.finalizados[i][4]+'</span>';
					prev += '</li>';
					prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					prev += '    <h6 class="my-0">Método de pago</h6>';
					prev += '    <span class="text-body-secondary">'+data.finalizados[i][5]+'</span>';
					prev += '</li>';
					prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
					prev += '    <span></span>';
					prev += '    <a data-bs-toggle="modal" data-bs-target="#detalles" href="#">Más Detalles</a>';
					prev += '</li>';					
					prev += '</ul>';
				}
				previos.html(prev);
			}else{
				prev += '<ul  class="list-group mb-3">';
				prev += '<li class="list-group-item d-flex justify-content-between lh-sm">';
				prev += '    <span></span>';
				prev += '    <h6 class="my-0">No hay registro de pedidos</h6>';
				prev += '</li>';
				prev += '</ul>';
				previos.html(prev);
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
		  console.log("Error en la solicitud:", errorThrown);
		}
  });
}

document.addEventListener("DOMContentLoaded", () => {
	if (document.URL.includes("pedidos.php")) {
		cargar_pedidos();
	}
})