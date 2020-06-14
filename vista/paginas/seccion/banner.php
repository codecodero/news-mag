<div class="bannerEstatico d-none d-md-block"></div>
<?php
$banners = BlogControler::MostrarBanner("inicio");
?>

<section class="jd-slider fade-slider">

	<div class="slide-inner">

		<ul class="slide-area">
		<?php foreach ($banners as $banrs => $banner): ?>
			<li><img src="<?php echo $blog['dominio'] . $banner['img_banner']; ?>" class="img-fluid"></li>
		<?php endforeach?>
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