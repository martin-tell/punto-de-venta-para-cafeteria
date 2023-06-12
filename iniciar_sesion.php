<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="html-elements/signin.css" rel="stylesheet">    
  </head>

  <body class="text-center" style="background-color: #f5f5f5;">
    <?php include "html-elements/nav-bar.html"; ?>
	<div class="py-2">
		<div id="error" class="invalid-tooltip sticky-top col-8 col-md-3 mx-auto">
			Usuario o contraseña incorrectos.
		</div>
		<div class="content">
				<form class="form-signin" id="form_login">
				  <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
  					<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
				  </svg>
				  <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
				  <div class="form-floating">
					<input name="user_lg" type="text" class="form-control" id="floatingInput" placeholder="Nombre de Usuario" required autofocus>
					<label for="floatingInput">Nombre de Usuario</label>
				  </div>
				  <div class="form-floating">
					<input name="pass_lg" type="password" class="form-control" id="floatingPassword" placeholder="Contraseña" required>
					<label for="floatingPassword">Contraseña</label>
				  </div>  
				  <button id="boton" class="btn btn-lg btn-primary btn-block w-100 mt-3 mb-3" type="submit">Iniciar Sesión</button>
				  <div class="text-center">
					<p>¿No tienes cuenta? <a class="text-decoration-none" href="registro.php">Regístrate</a> </p>
				  </div> 
				  <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
				</form>	
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="functions.js"></script>
  </body>
</html>