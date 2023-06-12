<!doctype html>
<html lang="es" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body class="bg-body-tertiary">
  <?php include "html-elements/nav-bar.html"; ?>
<div class="container">
  <main>
    <div class="py-3 text-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-card-heading" viewBox="0 0 16 16">
  	<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  	<path d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
      </svg>
      <h2>Registrar</h2>
      <p class="lead">Ingrese sus datos para crear una cuenta y acceder a los servicios de la aplicación</p>
    </div>

    <div class="row">
        <h4 class="mb-3 text-center">Complete sus datos</h4>
        <form class="needs-validation" id="form-signup">
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Nombre(s)</label>
              <input type="text" class="form-control" name="name" placeholder="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="last" placeholder="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="username" class="form-label">Nombre de Usuario</label>
              <div class="input-group has-validation">
                <span class="input-group-text">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
					<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                  </svg>
                </span>
                <input type="text" class="form-control" name="user" placeholder="Username" required>
				<div class="invalid-feedback" id="user_error">
                  Nombre de usuario no disponible
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <label for="email" class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" name="mail" placeholder="you@example.com" required>
              <div class="invalid-feedback" id="mail_error">
                Este correo ya esta asociado a una cuenta 
              </div>
            </div>

            <div class="col-sm-6">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" name="pass" placeholder="" required>
              <div class="invalid-feedback">
                Please enter your password.
              </div>
            </div>
            <div class="col-sm-6">
              <label for="password" class="form-label">Confirmar Contraseña</label>
              <input type="password" class="form-control" name="pass2" placeholder="" required>
              <div class="invalid-feedback" id="pass_error">
                Las contraseñas no coinciden
              </div>
            </div>
          <button class="col-md-5 btn btn-primary btn-lg mt-5 mx-auto" type="submit" id="boton">Registrar</button>
        </form>
    </div>
  </main>

	  <footer class="my-5 pt-5 text-body-secondary text-center text-small">
		<p class="mb-1">&copy; 2017–2023 Company Name</p>
		<ul class="list-inline">
		  <li class="list-inline-item"><a href="#">Privacy</a></li>
		  <li class="list-inline-item"><a href="#">Terms</a></li>
		  <li class="list-inline-item"><a href="#">Support</a></li>
		</ul>
	  </footer>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="functions.js"></script>
  </body>
</html>