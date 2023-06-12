<!doctype html>
<html lang="es" data-bs-theme="auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cafetería</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">        
        <link href="html-elements/carousel.css" rel="stylesheet">
    </head>
    <body>
        <?php include "html-elements/nav-bar.html"; ?>
        <?php include "html-elements/carousel.html"; ?>

        <div class="container marketing">
            <div class="row">
                <div class="col-lg-4">
					<svg class="pb-3" xmlns="http://www.w3.org/2000/svg" width="140" height="140" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
						<path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
					</svg>
                    <h2 class="fw-normal">Ordene en línea</h2>
                    <p>No es necesario hacer filas, haga sus pedidos desde la aplicación.</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <svg class="pb-3" xmlns="http://www.w3.org/2000/svg" width="140" height="140" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461L10.404 2Z"/>
					</svg>
                    <h2 class="fw-normal">Entregas a domicilio</h2>
                    <p>Indíquenos a través de la plataforma el lugar de entrega de su pedido.</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <svg class="pb-3" xmlns="http://www.w3.org/2000/svg" width="140" height="140" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
						<path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
						<path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>
					</svg>
                    <h2 class="fw-normal">Evite largas esperas</h2>
                    <p>Con nuestra aplicación nosotros le avisaremos cuando su pedido este listo.</p>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">Desayune o almuerze <span class="text-body-secondary">alguno de nuestros platillos</span></h2>
                    <p class="lead">Le ofrecemos opciones de desayuno como chilaquiles, cocteles de fruta, sincronizadas o almuerzos como tortas de milanesa, jamón, etc.</p>
                </div>
                <div class="col-md-5">
		    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text></svg>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">¿Tiene ganas de <span class="text-body-secondary">una bebida?</span></h2>
                    <p class="lead">Tenemos varias opciones como refrescos, cafés, jugos y licuados del sabor que más le agrade</p>
                </div>
                <div class="col-md-5 order-md-1">
		    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text></svg>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">Para el antojo <span class="text-body-secondary">del momento</span></h2>
                    <p class="lead">Difrute de las botanas que le ofrecemos como papas, cacahuates, galletas, gomitas, lo que más le agrade</p>
                </div>
                <div class="col-md-5">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text></svg>
                </div>
            </div>

            <hr class="featurette-divider">

        </div>

        <footer class="container">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2017–2023 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
		<script src="functions.js"></script>
    </body>
</html>