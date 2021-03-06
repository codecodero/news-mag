<div class="container-fluid bg-white contenidoInicio py-2 py-md-4">

	<div class="container">

		<!-- BREADCRUMB -->

		<ul class="breadcrumb bg-white p-0 mb-2 mb-md-4">

			<li class="breadcrumb-item inicio"><a href="<?php echo $blog['dominio']; ?>">Inicio</a></li>

			<li class="breadcrumb-item active"><?php echo ($articulos[0]['id'] != "Error: vacío") ? $articulos[0]['cat_descripcion'] : 'Sin Artículos'; ?></li>

		</ul>

		<div class="row">

			<!-- COLUMNA IZQUIERDA -->

			<div class="col-12 col-md-8 col-lg-9 p-0 pr-lg-5">
				<?php if ($articulos[0]['id'] != 'Error: vacío'): ?>
				<!-- ARTÍCULO 01 -->
                <?php foreach ($articulos as $key => $item): ?>
				<div class="row">

					<div class="col-12 col-lg-5">

						<a href="<?php echo $blog['dominio'] . $item['ruta'] ?>"><h5 class="d-block d-lg-none py-3"><?php echo $item['titulo']; ?></h5></a>

						<a href="<?php echo $blog['dominio'] . $item['ruta'] ?>"><img src="<?php echo $blog['cms'] . $item['img']; ?>" alt="Lorem ipsum dolor sit amet" class="img-fluid" width="100%"></a>

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
				<?php else: ?>
				<div class="row">
					<div class="col-12 col-lg-5">
					<p class ="pl-3 text-secundary">¡Esta Categorias aun no tiene Artículos!</p>
					</div>
				</div>
				<?php endif?>

				<!-- TODO:Paginación -->
				<div class="container d-none d-md-block">
					<?php if ($articulos[0]['id'] != 'Error: vacío'): ?>
					<ul class="pagination justify-content-center">

						<?php if ($dts_pg['seccion_actual'] != 1): ?>
						<li class="page-item first "><a href="<?php echo $blog['dominio'] . $catg; ?>/1" class="page-link">Primero</a></li>
						<?php endif?>

						<li class="page-item prev <?php echo ($dts_pg['pagina_actual'] == 1) ? 'disabled' : ''; ?>"><a href="<?php echo $blog['dominio'] . $catg . '/' . ($dts_pg['pagina_actual'] - 1); ?>" class="page-link"><i class="fas fa-angle-left"></i></a></li>

							<?php for ($i = $dts_pg['inicio_seccion']; $i <= $dts_pg['total_paginas']; $i++): ?>
						<li class="page-item <?php echo ($i == $dts_pg['pagina_actual']) ? 'active' : ''; ?>"><a href="<?php echo $blog['dominio'] . $catg . '/' . $i; ?>" class="page-link"><?php echo $i; ?></a></li>
							<?php endfor?>

						<li class="page-item next <?php echo ($dts_pg['pagina_actual'] == $dts_pg['total_paginas']) ? 'disabled' : ''; ?>"><a href="<?php echo $blog['dominio'] . $catg . '/' . ($dts_pg['pagina_actual'] + 1); ?>" class="page-link"><i class="fas fa-angle-right"></i></a></li>

						<?php if ($dts_pg['seccion_actual'] != $dts_pg['total_seccion']): ?>
						<li class="page-item first "><a href="<?php echo $blog['dominio'] . $catg . '/' . $dts_pg['total_paginas'] ?>" class="page-link">Último</a></li>
						<?php endif?>

					</ul>
						<?php endif?>
				</div>

			</div>

			<!-- COLUMNA DERECHA -->

			<div class="d-none d-md-block pt-md-4 pt-lg-0 col-md-4 col-lg-3">

				<!-- ETIQUETAS -->

				<div>

					<h4>Etiquetas</h4>

						<?php foreach (json_decode($articulos[0]['palabras_claves_cat'], true) as $data => $etiquetas): ?>
						<a href="<?php echo $blog['dominio'] . "search/" . strtolower(preg_replace('/[0-9ñáéíóú ]/', '_', $etiquetas)); ?>" class="btn btn-secondary btn-sm m-1"><?php echo $etiquetas; ?></a>
						<?php endforeach?>
				</div>
								<!-- PUBLICIDAD -->
				<?php
$data_ads = BlogControler::MostrarAds("sidebar");
foreach ($data_ads as $ads => $ad) {
    echo $ad['codigo_anuncio'];
}
?>

				<!-- Artículos Destacados -->

				<div class="my-4">

					<h4>Artículos Destacados</h4>
<?php
$id_categoria = $articulos[0]['id_categoria'];
PaginacionControl::config(1, 4, null, "SELECT a.id,a.id_categoria,c.categoria,c.descripcion as cat_descripcion,c.palabras_claves as palabras_claves_cat,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido,a.vista,DATE_FORMAT(a.created_at,'%d.%m.%Y') as fecha FROM articulo a INNER JOIN categoria c ON c.id = a.id_categoria WHERE a.id_categoria=$id_categoria", 4);
$feacture_articles = PaginacionControl::MostrarFilas("vista", "DESC");
?>
					<?php foreach ($feacture_articles as $feactures => $articls): ?>
					<div class="d-flex my-3">

						<div class="w-100 w-xl-50 pr-3 pt-2">

							<a href="<?php echo $blog['dominio'] . $articls['ruta']; ?>">

								<img src="<?php echo $blog['cms'] . $articls['img']; ?>" alt="<?php echo $articls['titulo']; ?>" class="img-fluid">

							</a>

						</div>

						<div>

							<a href="<?php echo $blog['dominio'] . $articls['ruta']; ?>" class="text-secondary">

								<p class="small"><?php echo $articls['titulo']; ?></p>

							</a>

						</div>

					</div>

					<?php endforeach?>


				</div>

				<!-- PUBLICIDAD -->
				<?php
$data_ads = BlogControler::MostrarAds("horizontal");
foreach ($data_ads as $ads => $ad) {
    echo $ad['codigo_anuncio'];
}
?>

			</div>

		</div>

	</div>

</div>