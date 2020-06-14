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
					<div id="mc_embed_signup">
						<div class="mc-field-group">
							<form action="https://tomorrowlandlatino.us4.list-manage.com/subscribe/post?u=9eb692b59d8609fca8d35cf7b&amp;id=ae2568ac5a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<div class="input-group my-4">
									<input type="email" class="form-control required email" placeholder="Ingresa tu Email" id="mce-EMAIL" required>
									<div class="input-group-append">
										<span class="input-group-text bg-dark text-white">
										<input type="submit" value="Suscribirse" name="subscribe" id="mc-embedded-subscribe" class="button btn btn-dark text-white btn-sm p-0 m-0">
										</span>
									</div>
								</div>
							</form>
							<div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>
							</div>
							<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_9eb692b59d8609fca8d35cf7b_ae2568ac5a" tabindex="-1" value=""></div>
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