<?php
include "seccion/banner.php";
?>
<div class="container-fluid bg-white">
    <div class="container py-4">
        <!-- <?php echo $blog['sobre_mi']; ?> -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <img src="<?=$blog['img_sobre_mi']?>" class="card-img-top" alt="<?=$blog['titulo']?>">
                    <div class="card-body">
                        <h5 class="card-title"><?=$blog['titulo']?></h5>
                        <p class="card-text"><?=$blog['sobre_mi']?></p>
                        <a href="<?=$blog['dominio'];?>" class="btn btn-primary">Ir a inicio</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            <form>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="Correo">Correo</label>
                    <input type="text" class="form-control" id="Correo" placeholder="Correo">
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea class="form-control" id="mensaje" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-success" id="btn_contact">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>
</div>
