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


jQuery(document).on('submit', '#form_login', function(event){
	event.preventDefault();
	if (window.location.pathname.includes("iniciar_sesion.php")) {
		$.ajax({
			url: 'login.php',
			type: 'POST',
			dataType: 'json',
			data: $(this).serialize(),
			beforeSend: function(){
				$('#boton').text('Validando...');
			}
		})
		.done(function(respuesta){
			if(!respuesta.error){
				if(respuesta.tipo === "administrador"){
					location.href = "Administrador/index.php";
				}else if(respuesta.tipo === "cliente"){
					location.href = "Cliente/index.php";
				}
			}else{
				$('#error').slideDown('slow');
				setTimeout(function(){
					$('#error').slideUp('slow');
				},3000);
				$('#boton').text('Iniciar Sesión');
			}
		})
		.fail(function(resp){
			console.log(resp.responseText);
		})
		.always(function(){
			console.log("complete");
		});
	}
});

jQuery(document).on('submit', '#form-signup', function(event){
	event.preventDefault();
	if (window.location.pathname.includes("registro.php")) {
		$.ajax({
			url: 'signUp.php',
			type: 'POST',
			dataType: 'json',
			data: $(this).serialize(),
			beforeSend: function(){
				$('#boton').text('Registrando...');
			}
		})
		.done(function(respuesta){
			console.log(respuesta);
			if(respuesta.insert){
				alert('¡Registro exitoso! Gracias por registrarte.');
				location.href = "iniciar_sesion.php";
			}else{
				if(respuesta.user){
					$('#user_error').slideDown('slow');
					setTimeout(function(){
						$('#user_error').slideUp('slow');
					},3000);
				}
				if(respuesta.mail){
					$('#mail_error').slideDown('slow');
					setTimeout(function(){
						$('#mail_error').slideUp('slow');
					},3000);
				}
				if(!respuesta.pass_match){
					$('#pass_error').slideDown('slow');
					setTimeout(function(){
						$('#pass_error').slideUp('slow');
					},3000);
				}
				$('#boton').text('Registrar');
			}
		})
		.fail(function(resp){
			alert('Ha ocurrido un error. Intentelo mas tarde.');
			console.log(resp.responseText);
		})
		.always(function(){
			console.log("complete");
		});
	}
});

