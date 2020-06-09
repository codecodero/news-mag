<div class="container-fluid menu">
	<a href="#" class="btnClose">&times;</a>
	<ul class="nav flex-column text-center">
		<?php foreach ($categorias as $key => $value): ?>
			<li class="nav-item">
				<a class="nav-link text-white" href="<?php echo $blog['dominio'] . $value['ruta']; ?>"><?php echo $value['descripcion']; ?></a>
			</li>
		<?php endforeach?>

	</ul>

</div>