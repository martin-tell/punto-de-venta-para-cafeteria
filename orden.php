<!doctype html>
<html lang="es" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="checkout.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
    <?php include "html-elements/nav-bar.html"; ?>
    <div class="container">
        <main>
            <div class="py-3 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                </svg>
                <h2 class="mt-4">Orden de Compra</h2>
                <p class="lead">Vea los productos seleccionados en su orden actual, modifiquela si es necesario o proceda al pago y solicite el envío</p>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Su Orden</span>
                        <span class="badge bg-primary rounded-pill">0</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
				<p class="text-center">
					<a class="text-decoration-none" href="iniciar_sesion.php">Ingrese</a> 
					o 
					<a class="text-decoration-none" href="registro">Registrese</a> 
					para realizar una orden
				</p>
                        </li>
                    </ul>

                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Código de Descuento" disabled>
                            <button type="submit" class="btn btn-secondary" disabled>Canjear</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Datos de envío</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Calle </label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required disabled>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Número de Domicilio</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" required disabled>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="username" class="form-label">Colonia</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="username" required disabled>
                                    <div class="invalid-feedback">
                                        Your username is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Código Postal <span class="text-body-secondary">(Optional)</span></label>
                                <input type="email" class="form-control" id="email" disabled>
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Pago</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="cash" name="paymentMethod" type="radio" class="form-check-input" checked required disabled>
                                <label class="form-check-label" for="cash">En efectivo <span class="text-body-secondary">(Al llegar el pedido)</span></label>
                            </div>
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input"required disabled>
                                <label class="form-check-label" for="credit">Tarjeta de Crédito</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required disabled>
                                <label class="form-check-label" for="debit">Tarjeta de Débito</label>
                            </div>
                        </div>

                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Titular</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required disabled>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Número de Tarjeta</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required disabled>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Fecha de Vencimiento</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required disabled>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required disabled>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit" disabled>Realizar Pedido</button>
                    </form>
                </div>
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

</body>

</html>