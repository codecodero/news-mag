<footer class="container-fluid py-5 d-none d-md-block">

	<div class="container">

		<div class="row">

		<!-- GRID CATEGORÍAS FOOTER -->

			<div class="col-md-7 col-lg-6">
				<div class="p-1 bg-white gridFooter">
					<div class="container p-0">
						<div class="d-flex">
							<div class="d-flex flex-column columna1">
								<figure class="p-2 m-0 photo1" vinculo="<?php echo $blog['dominio'] . $categorias[0]['ruta']; ?>" style="background: url(<?php echo $blog['dominio'] . $categorias[0]['img']; ?> );">
									<p class="text-uppercase p-1 p-md-2 p-xl-1 small"><?php echo $categorias[0]['categoria']; ?></p>
								</figure>
								<figure class="p-2 m-0 photo2" vinculo="<?php echo $blog['dominio'] . $categorias[1]['ruta']; ?>" style="background: url(<?php echo $blog['dominio'] . $categorias[1]['img']; ?> );">
									<p class="text-uppercase p-1 p-md-2 p-xl-1 small"><?php echo $categorias[1]['categoria']; ?></p>
								</figure>
							</div>
							<div class="d-flex flex-column flex-fill columna2">
								<div class="d-block d-md-flex">
									<figure class="p-2 m-0 flex-fill photo3" vinculo="<?php echo $blog['dominio'] . $categorias[2]['ruta']; ?>" style="background: url(<?php echo $blog['dominio'] . $categorias[2]['img']; ?> );">
										<p class="text-uppercase p-1 p-md-2 p-xl-1 small"><?php echo $categorias[2]['categoria']; ?></p>
									</figure>
									<figure class="p-2 m-0 flex-fill photo4" vinculo="<?php echo $blog['dominio'] . $categorias[3]['ruta']; ?>" style="background: url(<?php echo $blog['dominio'] . $categorias[3]['img']; ?> );">
										<p class="text-uppercase p-1 p-md-2 p-xl-1 small"><?php echo $categorias[3]['categoria']; ?></p>
									</figure>
								</div>
								<figure class="p-2 m-0 photo5" vinculo="<?php echo $blog['dominio'] . $categorias[4]['ruta']; ?>" style="background: url(<?php echo $blog['dominio'] . $categorias[4]['img']; ?> );">
									<p class="text-uppercase p-1 p-md-2 p-xl-1 small"><?php echo $categorias[4]['categoria']; ?></p>
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
						<?php foreach (json_decode($blog['redes_sociales'], true) as $key => $value): ?>
							<li>
								<a href="<?php echo $value['url']; ?>" target="_blank">
									<i class="<?php echo $value['icono']; ?> lead text-white mr-3 mr-sm-4"></i>
								</a>
							</li>
						<?php endforeach?>

					</ul>

				</div>

			</div>

		</div>

	</div>

</footer>