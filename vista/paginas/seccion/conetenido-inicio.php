<div class="container-fluid bg-white contenidoInicio pb-4">

	<div class="container">

		<div class="row">

			<!-- COLUMNA IZQUIERDA -->

			<div class="col-12 col-md-8 col-lg-9 p-0 pr-lg-5">
				<!-- ARTÍCULO 01 -->
			<?php foreach ($articulos as $key => $item): ?>
				<div class="row">

					<div class="col-12 col-lg-5">

						<a href="<?php echo $blog['dominio'] . $item['ruta'] ?>"><h5 class="d-block d-lg-none py-3"><?php echo $item['titulo']; ?></h5></a>

						<a href="<?php echo $blog['dominio'] . $item['ruta'] ?>"><img src="<?php echo $item['img']; ?>" alt="Lorem ipsum dolor sit amet" class="img-fluid" width="100%"></a>

					</div>

					<div class="col-12 col-lg-7 introArticulo">

						<a href="<?php echo $blog['dominio'] . $item['ruta'] ?>"><h4 class="d-none d-lg-block"><?php echo $item['titulo']; ?></h4></a>

						<p class="my-2 my-lg-5"><?php echo $item['descripcion']; ?></p>

						<a href="<?php echo $blog['dominio'] . $item['ruta'] ?>" class="float-right">Leer Más</a>

						<div class="fecha"><?php echo $item['fecha']; ?></div>

					</div>


				</div>
				<hr class="mb-4 mb-lg-5" style="border: 1px solid #79FF39">
				<?php endforeach?>

				<!-- FIXME:Paginación -->
				<div class="container d-none d-md-block">
					<?php if ($articulos[0]['id'] != 'Error: vacío'): ?>
					<ul class="pagination justify-content-center">

						<?php if ($datos_pag['seccion_actual'] != 1): ?>
						<li class="page-item first "><a href="1" class="page-link">Primero</a></li>
						<?php endif?>

						<li class="page-item prev <?php echo ($datos_pag['pagina_actual'] == 1) ? 'disabled' : ''; ?>"><a href="<?php echo ($datos_pag['pagina_actual'] - 1); ?>" class="page-link"><i class="fas fa-angle-left"></i></a></li>

							<?php for ($i = $datos_pag['inicio_seccion']; $i <= $datos_pag['total_paginas']; $i++): ?>
						<li class="page-item <?php echo ($i == $datos_pag['pagina_actual']) ? 'active' : ''; ?>"><a href="<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
							<?php endfor?>

						<li class="page-item next <?php echo ($datos_pag['pagina_actual'] == $datos_pag['total_paginas']) ? 'disabled' : ''; ?>"><a href="<?php echo ($datos_pag['pagina_actual'] + 1); ?>" class="page-link"><i class="fas fa-angle-right"></i></a></li>

						<?php if ($datos_pag['seccion_actual'] != $datos_pag['total_seccion']): ?>
						<li class="page-item first "><a href="<?php echo $datos_pag['total_paginas'] ?>" class="page-link">Último</a></li>
						<?php endif?>

					</ul>
						<?php endif?>
				</div>

			</div>

			<!-- COLUMNA DERECHA -->

			<div class="d-none d-md-block pt-md-4 pt-lg-0 col-md-4 col-lg-3">

				<!-- SOBRE MI -->

				<div class="sobreMi">

					<h4>Sobre Mi</h4>

					<img src="<?php echo $blog['dominio']; ?>vista/img/sobreMi.jpg" alt="Lorem ipsum dolor sit amet" class="img-fluid my-1">

					<p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum odio, eos architecto atque numquam alias laboriosam minima beatae consectetur.</p>

				</div>

				<!-- Artículos destacados -->

				<div class="my-4">

					<h4>Artículos Destacados</h4>
<?php
PaginacionControl::config(1, 4, null, "SELECT a.id,a.id_categoria,c.categoria,c.descripcion as cat_descripcion,c.palabras_claves as palabras_claves_cat,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido,a.vista,DATE_FORMAT(a.fecha,'%d.%m.%Y') as fecha FROM articulo a INNER JOIN categoria c ON c.id = a.id_categoria", 4);
$feacture_article = PaginacionControl::MostrarFilas("vista", "DESC");
?>
					<?php foreach ($feacture_article as $feartures => $feacture_articles): ?>
					<div class="d-flex my-3">
						<div class="w-100 w-xl-50 pr-3 pt-2">
							<a href="<?php echo $blog['dominio'] . $feacture_articles['ruta']; ?>">
								<img src="<?php echo $blog['dominio'] . $feacture_articles['img']; ?>" alt="<?php echo $feacture_articles['titulo']; ?>" class="img-fluid">
							</a>
						</div>
						<div>
							<a href="<?php echo $blog['dominio'] . $feacture_articles['ruta']; ?>" class="text-secondary">
								<p class="small"><?php echo $feacture_articles['titulo']; ?></p>
							</a>
						</div>
					</div>
					<?php endforeach?>

				</div>
				<!-- PUBLICIDAD -->

				<div class="my-4">

					<img src="<?php echo $blog['dominio']; ?>vista/img/ad01.jpg" class="img-fluid">

				</div>

				<div class="my-4">

					<img src="<?php echo $blog['dominio']; ?>vista/img/ad02.jpg" class="img-fluid">

				</div>

				<div class="my-4">

					<img src="<?php echo $blog['dominio']; ?>vista/img/ad05.png" class="img-fluid">

				</div>

			</div>

		</div>

	</div>

</div>

