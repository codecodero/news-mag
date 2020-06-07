<?php
const URL_HOST = "http://localhost/news-mag/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Juanito Travel</title>

	<link rel="icon" href="<?php echo URL_HOST;?>vista/img/icono.jpg">

	<!--=====================================
	PLUGINS DE CSS
	======================================-->
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<link href="https://fonts.googleapis.com/css?family=Chewy|Open+Sans:300,400" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

	<!-- JdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<link rel="stylesheet" href="<?php echo URL_HOST;?>vista/css/plugins/jquery.jdSlider.css">

	<link rel="stylesheet" href="<?php echo URL_HOST;?>vista/css/style.css">

	<!--=====================================
	PLUGINS DE JS
	======================================-->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<!-- JdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<script src="<?php echo URL_HOST;?>vista/js/plugins/jquery.jdSlider-latest.js"></script>
	
	<!-- pagination -->
	<!-- http://josecebe.github.io/twbs-pagination/ -->
	<script src="<?php echo URL_HOST;?>vista/js/plugins/pagination.min.js"></script>

	<!-- scrollup -->
	<!-- https://markgoodyear.com/labs/scrollup/ -->
	<!-- https://easings.net/es# -->
	<script src="<?php echo URL_HOST;?>vista/js/plugins/scrollUP.js"></script>
	<script src="<?php echo URL_HOST;?>vista/js/plugins/jquery.easing.js"></script>

</head>
<body>
<!-- de aquí -->
<header class="container-fluid">
	
	<div class="container p-0">
		
		<div class="row">
			
			<!-- LOGO -->
			<div class="col-10 col-sm-11 col-md-8 pt-1 pt-lg-3 p-xl-0">
				
				<a href="http://localhost/news-mag/">
					
					<img src="http://localhost/news-mag/vista/img/logotipo-negativo.png" alt="Logo de Juanito Travel" class="img-fluid logotipo">

				</a>

			</div>

			<!-- REDES SOCIALES -->
			<div class="d-none d-md-block col-md-2 redes">
				
				<ul class="d-flex justify-content-end pt-3 mt-1">
					
					<li>
						<a href="https://www.facebook.com" target="_blank">
							<i class="fab fa-facebook-f lead rounded-circle text-white mr-1"></i>
						</a>
					</li>

					<li>
						<a href="#" target="_blank">
							<i class="fab fa-instagram lead rounded-circle text-white mr-1"></i>
						</a>
					</li>

					<li>
						<a href="#" target="_blank">
							<i class="fab fa-twitter lead rounded-circle text-white mr-1"></i>
						</a>
					</li>

					<li>
						<a href="#" target="_blank">
							<i class="fab fa-youtube lead rounded-circle text-white mr-1"></i>
						</a>
					</li>

					<li>
						<a href="#" target="_blank">
							<i class="fab fa-snapchat-ghost lead rounded-circle text-white mr-1"></i>
						</a>
					</li>

				</ul>

			</div>

			<!-- BUSCADOR Y BOTÓN MENÚ -->
			<div class="col-2 col-sm-1 col-md-2 d-flex justify-content-end pt-3 mt-1">
				
				<!-- BUSCADOR -->
				<div class="d-none d-md-block pr-4 pr-lg-5 mt-1">
					<i class="fas fa-search lead" data-toggle="collapse" data-target="#buscador"></i>
				</div>	

				<!-- BOTÓN MENÚ -->
				<div class="m-0 mt-sm-1 mt-md-0 pr-0 pr-sm-2 pr-lg-3">
					<i class="fas fa-bars lead"></i>
				</div>
				
			</div>

			<!-- ENTRADA DEL BUSCADOR -->

			<div id="buscador" class="collapse col-12">
				
				<div class="input-group float-right w-50 pl-xl-5 pb-3">
					
					<input type="text" class="form-control" placeholder="Buscar">

					<div class="input-group-append">
						
						<span class="input-group-text bg-primary border-0" style="cursor:pointer">
							
							<i class="fas fa-search"></i>

						</span>

					</div>

				</div>

			</div>

		</div>

	</div>

</header>
<div class="d-block d-md-none redes redesMovil p-0 bg-white w-100 pt-2">
				
	<ul class="d-flex justify-content-center p-0">
		
		<li>
			<a href="https://www.facebook.com" target="_blank">
				<i class="fab fa-facebook-f lead rounded-circle text-white mr-3 mr-sm-4"></i>
			</a>
		</li>

		<li>
			<a href="#" target="_blank">
				<i class="fab fa-instagram lead rounded-circle text-white mr-3 mr-sm-4"></i>
			</a>
		</li>

		<li>
			<a href="#" target="_blank">
				<i class="fab fa-twitter lead rounded-circle text-white mr-3 mr-sm-4"></i>
			</a>
		</li>

		<li>
			<a href="#" target="_blank">
				<i class="fab fa-youtube lead rounded-circle text-white mr-3 mr-sm-4"></i>
			</a>
		</li>

		<li>
			<a href="#" target="_blank">
				<i class="fab fa-snapchat-ghost lead rounded-circle text-white mr-3 mr-sm-4"></i>
			</a>
		</li>

	</ul>

</div><div style="margin-top:90px" class="container-fluid d-block pb-3 d-md-none bg-white">
	
	<div class="input-group input-group-sm">

		<input type="text" class="form-control" placeholder="Buscar">

		<div class="input-group-append">

			<span class="input-group-text"><i class="fas fa-search"></i></span>

		</div>
	</div>

</div>
<div class="container-fluid menu">

	<a href="#" class="btnClose">X</a>

	<ul class="nav flex-column text-center">

		<li class="nav-item">

			<a class="nav-link text-white" href="categorias">Mi viaje por Suramérica</a>

		</li>

		<li class="nav-item">

			<a class="nav-link text-white" href="categorias.html">Mi viaje por Centroamérica</a>

		</li>

		<li class="nav-item">

			<a class="nav-link text-white" href="categorias.html">Mi viaje por Norteamérica</a>

		</li>

		<li class="nav-item">

			<a class="nav-link text-white" href="categorias.html">Mi viaje por Europa</a>

		</li>

		<li class="nav-item">

			<a class="nav-link text-white" href="categorias.html">Mi viaje por Asia</a>

		</li>

		<li class="nav-item">

			<a class="nav-link text-white" href="categorias.html">Mi viaje por Africa</a>

		</li>

		<li class="nav-item">

			<a class="nav-link text-white" href="categorias.html">Mi viaje por Oceanía</a>

		</li>

	</ul>

</div>
	<?php
    $plantillaControl = new PlantillaControler();
	$plantillaControl->urls();
    ?>
<footer class="container-fluid py-5 d-none d-md-block">
	
	<div class="container">
		
		<div class="row">

		<!-- GRID CATEGORÍAS FOOTER -->
			
			<div class="col-md-7 col-lg-6">
				
				<div class="p-1 bg-white gridFooter">

					<div class="container p-0">

						<div class="d-flex">

							<div class="d-flex flex-column columna1">
							
								<figure class="p-2 m-0 photo1" vinculo="categorias.html">
									
									<p class="text-uppercase p-1 p-md-2 p-xl-1 small">Suramérica</p>

								</figure>

								<figure class="p-2 m-0 photo2" vinculo="categorias.html">
									
									<p class="text-uppercase p-1 p-md-2 p-xl-1 small">Africa</p>

								</figure>								

							</div>

							<div class="d-flex flex-column flex-fill columna2">

								<div class="d-block d-md-flex">

									<figure class="p-2 m-0 flex-fill photo3" vinculo="categorias.html">

										<p class="text-uppercase p-1 p-md-2 p-xl-1 small">Centromérica</p>
										
									</figure>

									<figure class="p-2 m-0 flex-fill photo4" vinculo="categorias.html">
										
										<p class="text-uppercase p-1 p-md-2 p-xl-1 small">Europa</p>

									</figure>

								</div>

								<figure class="p-2 m-0 photo5" vinculo="categorias.html">

									<p class="text-uppercase p-1 p-md-2 p-xl-1 small">Norteamérica</p>
									
								</figure>

							</div>

						</div>

					</div>

				</div>
					
			</div>

			<div class="d-none d-lg-block col-lg-1 col-xl-2"></div>

			<!-- NEWLETTER -->

			<div class="col-md-5 col-lg-5 col-xl-4 pt-5">
				
				<h6 class="text-white">Inscríbete en nuestro newletter:</h6>

				<div class="input-group my-4">
					
					<input type="text" class="form-control" placeholder="Ingresa tu Email">

					<div class="input-group-append">
						
						<span class="input-group-text bg-dark text-white">Inscribirse</span>

					</div>

				</div>

				<div class="p-0 w-100 pt-2">
				
					<ul class="d-flex justify-content-left p-0">
						
						<li>
							<a href="https://www.facebook.com" target="_blank">
								<i class="fab fa-facebook-f lead text-white mr-3 mr-sm-4"></i>
							</a>
						</li>

						<li>
							<a href="#" target="_blank">
								<i class="fab fa-instagram lead text-white mr-3 mr-sm-4"></i>
							</a>
						</li>

						<li>
							<a href="#" target="_blank">
								<i class="fab fa-twitter lead text-white mr-3 mr-sm-4"></i>
							</a>
						</li>

						<li>
							<a href="#" target="_blank">
								<i class="fab fa-youtube lead text-white mr-3 mr-sm-4"></i>
							</a>
						</li>

						<li>
							<a href="#" target="_blank">
								<i class="fab fa-snapchat-ghost lead text-white mr-3 mr-sm-4"></i>
							</a>
						</li>

					</ul>

				</div>

			</div>

		</div>

	</div>

</footer>
<script src="<?php echo URL_HOST;?>vista/js/script.js"></script>
</body>
</html>