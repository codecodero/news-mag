<div class="bannerEstatico d-none d-md-block"></div>

<section class="jd-slider fade-slider">

	<div class="slide-inner">

		<ul class="slide-area">

			<li>

				<div class="d-none d-md-block textoBanner">

					<h1>Watch how we work</h1>
					<h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit ea quidem</h5>

				</div>

				<img src="<?php echo $blog['dominio']; ?>vista/img/bannerGrande01.jpg" class="img-fluid">

			</li>

		</ul>

	</div>

	<div class="controller d-none">

		<a class="auto" href="#">

			<i class="fas fa-play fa-xs"></i>
			<i class="fas fa-pause fa-xs"></i>

		</a>

		<div class="indicate-area"></div>

	</div>

</section>
<div class="container-fluid bg-white contenidoInicio py-2 py-md-4">

	<div class="container">

		<!-- BREADCRUMB -->

		<a href="<?php echo $blog['dominio'] . $articulo['ruta_cat']; ?>">

			<button class="d-block d-sm-none btn btn-info btn-sm mb-2">

				REGRESAR

			</button>

		</a>

		<ul class="breadcrumb bg-white p-0 mb-2 mb-md-4 breadArticulo">

			<li class="breadcrumb-item inicio"><a href="<?php echo $blog['dominio']; ?>">Inicio</a></li>

			<li class="breadcrumb-item"><a href="<?php echo $blog['dominio'] . $articulo['ruta_cat']; ?>"><?php echo $articulo['cat_descripcion']; ?></a></li>

			<li class="breadcrumb-item active"><?php echo $articulo['titulo']; ?></li>

		</ul>

		<div class="row">

			<!-- COLUMNA IZQUIERDA -->

			<div class="col-12 col-md-8 col-lg-9 p-0 pr-lg-5">

				<!-- ARTÍCULO 01 -->

				<div class="container">

					<div class="d-flex">

						<div class="fechaArticulo"><?php echo $articulo['fecha']; ?></div>

						<h3 class="tituloArticulo text-right text-muted pl-3 pt-lg-2"><?php echo $articulo['titulo']; ?></h3>

					</div>

					<?php echo $articulo['contenido']; ?>

					<!-- COMPARTIR EN REDES -->

					<div class="float-right my-3 btnCompartir">

						<div class="btn-group text-secondary">

							Si te gusto compartelo:

						</div>

						<div class="btn-group">

							<button type="button" class="btn border-0 text-white" style="background: #1475E0">

								<span class="fab fa-facebook pr-1"></span>

								Facebook

							</button>

						</div>

						<div class="btn-group">

							<button type="button" class="btn border-0 text-white" style="background: #00A6FF">

								<span class="fab fa-twitter pr-1"></span>

								Twitter

							</button>

						</div>

					</div>

					<!-- AVANZAR - RETROCEDER -->

					<div class="clearfix"></div>

					<!-- ETIQUETAS -->

					<div>
						<h4>Etiquetas</h4>
						<?php foreach (json_decode($articulo['palabras_claves'], true) as $key => $value): ?>
							<a href="#<?php echo $value; ?>" class="btn btn-secondary btn-sm m-1"><?php echo $value; ?></a>
						<?php endforeach?>

					</div>

				 	<!-- <div class="d-md-flex justify-content-between my-3 d-none">

					    <a href="articulos.html">Leer artículo anterior</a>

					    <a href="articulos.html">Leer artículo siguiente</a>

				  	</div> -->

				  	<!-- DESLIZADOR DE ARTÍCULOS -->

				  	<section class="jd-slider deslizadorArticulos my-4">

						<div class="slide-inner">
<?php
$pagina = 1;
$postXpagina = 5;
$id_cat_art = $articulo['id_categoria'];
PaginacionControl::config($pagina, $postXpagina, null, "SELECT a.id,a.id_categoria,c.categoria,c.descripcion as cat_descripcion,c.palabras_claves as palabras_claves_cat,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido,a.vista,DATE_FORMAT(a.fecha,'%d.%m.%Y') as fecha FROM articulo a INNER JOIN categoria c ON c.id = a.id_categoria WHERE a.id_categoria='$id_cat_art'", 5);
$articles_data = PaginacionControl::MostrarFilas("id", "DESC");
?>
							<ul class="slide-area">
							<?php foreach ($articles_data as $articles_rel => $article_rel): ?>
							<?php if ($article_rel['id'] != $articulo['id']): ?>
								<li class="px-3">
									<a href="<?php echo $blog['dominio'] . $article_rel['ruta']; ?>" class="text-secondary">
										<img src="<?php echo $article_rel['img']; ?>" alt="Lorem ipsum dolor sit amet" class="img-fluid">
										<h6 class="py-2"><?php echo $article_rel['titulo']; ?></h6>
									</a>
									 <p class="small"><?php echo substr($article_rel['descripcion'], 0, 50) . "..."; ?> <a href="<?php echo $blog['dominio'] . $article_rel['ruta']; ?>" class="float-right btn btn-link btn-small">Leer más</a></p>
								</li>
								<?php endif?>
								<?php endforeach?>
							</ul>

							<a class="prev" href="#">

				                <i class="fas fa-angle-left text-muted"></i>

				            </a>

				            <a class="next" href="#">

				                <i class="fas fa-angle-right text-muted"></i>

				            </a>

						</div>

						 <div class="controller">

				            <div class="indicate-area"></div>

				        </div>

				  	</section>

				  	<!-- BLOQUE DE OPINIONES -->

				  	<h3 style="color:#8e4876">Opiniones</h3>

				  	<hr style="border: 1px solid #79FF39">
					  <?php $comments = BlogControler::MostrarOpiones($articulo['id']);?>
					<div class="row opiniones">
					<?php if (count($comments) == 0): ?>
					<p class ="pl-3 text-secundary">¡Este articulo no tiene comentarios!</p>
					<?php else: ?>
					<?php foreach ($comments as $data => $comment): ?>
						<?php if ($comment['estado'] != 0): ?>
							<div class="col-3 col-sm-4 col-lg-2 p-2">
								<img src="<?php echo $blog['dominio'] . $comment['img_usuario']; ?>" class="img-thumbnail">
							</div>
							<div class="col-9 col-sm-8 col-lg-10 p-2 text-muted">
								<p><?php echo $comment['comentario']; ?></p>
								<?php $formatter_date = strtotime($comment['fecha']);?>
								<span class="small float-right"><?php echo $comment['nombre_usuario'] . ' | ' . date('d.m.Y', $formatter_date); ?></span>
							</div>
							<?php if ($comment['respuesta_comentario']): ?>
							<div class="col-9 col-sm-8 col-lg-10 p-2 text-muted">
								<p><?php echo $comment['respuesta_comentario']; ?></p>
								<?php $formatter_date = strtotime($comment['fecha_respuesta']);?>
								<span class="small float-right"><?php echo $comment['admin'] . ' | ' . date('d.m.Y', $formatter_date); ?></span>
							</div>
							<div class="col-3 col-sm-4 col-lg-2 p-2">
								<img src="<?php echo $blog['dominio'] . $comment['img_admin']; ?>" class="img-thumbnail">
							</div>
							<?php endif?>
						<?php endif?>
						<?php endforeach?>
						<?php endif?>
					</div>

					<hr style="border: 1px solid #79FF39">

					<!-- FORMULARIO DE OPINIONES -->

					<form method="post" enctype="multipart/form-data" >
						<label class="text-muted lead">¿Qué tal te pareció el artículo?</label>
						<input type="hidden" name="id_article" value="<?php echo $articulo['id']; ?>">
						<div class="row">
							<div class="col-12 col-md-8 col-lg-9">
								<div class="input-group-lg">
									<input type="text" class="form-control my-3" placeholder="Tu nombre" name="nombre_comment">
									<input type="email" class="form-control my-3" placeholder="Tu email" name="correo_comment">
								</div>
							</div>
							<input type="file" name="foto_comment" class="d-none" id="foto_comment">
							<label for="foto_comment" class="d-none d-md-block col-md-4 col-lg-3">
								<img src="<?php echo $blog['dominio']; ?>vista/img/subirFoto.png" class="img-fluid mt-md-3 mt-xl-2 img_comment">
							</label>
						</div>
						<textarea class="form-control my-3" rows="7" placeholder="Escribe aquí tu mensaje" name="comment"></textarea>
						<input type="submit" class="btn btn-dark btn-lg btn-block mb-3" value="Enviar">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $save_comment = BlogControler::GuardarComentario();
    if ($save_comment >= 1) {
        echo '<script>
        notie.alert({
            type:1,
            text:"Se envio para aprovación",
            time:10
        });
    </script>';
    } else {
        echo '<script>
        notie.alert({
            type:3,
            text:"' . $save_comment . '",
            time:10
        });
    </script>';
    }
}
?>
					</form>
					<!-- PUBLICIDAD -->

					<img src="<?php echo $blog['dominio']; ?>vista/img/ad01.jpg" class="img-fluid my-3 d-block d-md-none" width="100%">
				</div>
			</div>

			<!-- COLUMNA DERECHA -->
			<div class="d-none d-md-block pt-md-4 pt-lg-0 col-md-4 col-lg-3">
				<!-- ARTÍCULOS RECIENTES -->
				<div class="my-4">
					<h4>Artículos Recientes</h4>
					<div class="d-flex my-3">
						<div class="w-100 w-xl-50 pr-3 pt-2">
							<a href="articulos.html">
								<img src="<?php echo $blog['dominio']; ?>vista/img/articulo05.png" alt="Lorem ipsum dolor sit amet" class="img-fluid">

							</a>

						</div>

						<div>

							<a href="articulos.html" class="text-secondary">

								<p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

							</a>

						</div>

					</div>

					<div class="d-flex my-3">

						<div class="w-100 w-xl-50 pr-3 pt-2">

							<a href="articulos.html">

								<img src="<?php echo $blog['dominio']; ?>vista/img/articulo06.png" alt="Lorem ipsum dolor sit amet" class="img-fluid">

							</a>

						</div>

						<div>

							<a href="articulos.html" class="text-secondary">

								<p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

							</a>

						</div>

					</div>

					<div class="d-flex my-3">

						<div class="w-100 w-xl-50 pr-3 pt-2">

							<a href="articulos.html">

								<img src="<?php echo $blog['dominio']; ?>vista/img/articulo07.png" alt="Lorem ipsum dolor sit amet" class="img-fluid">

							</a>

						</div>

						<div>

							<a href="articulos.html" class="text-secondary">

								<p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

							</a>

						</div>

					</div>


				</div>

				<!-- PUBLICIDAD -->

				<div class="mb-4">

					<img src="<?php echo $blog['dominio']; ?>vista/img/ad03.png" class="img-fluid">

				</div>

				<div class="my-4">

					<img src="<?php echo $blog['dominio']; ?>vista/img/ad02.jpg" class="img-fluid">

				</div>

				<div class="my-4">

					<img src="<?php echo $blog['dominio']; ?>vista/img/ad06.png" class="img-fluid">

				</div>

			</div>

		</div>

	</div>

</div>