<?php
if (isset($_FILES['img']['name'])) {
    if (!$_FILES['img']['error']) {
        $titulo    = md5(rand(10, 999));
        $extension = explode('.', $_FILES['img']['name']);
        $archivo   = $titulo . "." . $extension[1];
        $destino   = '../img/temp/' . $archivo;
        $origen    = $_FILES['img']['tmp_name'];
        move_uploaded_file($origen, $destino);
        echo $_POST['ruta'] . "/news-mag/cms/public/img/temp/" . $archivo;
    } else {
        echo $mensaje = "Error en: " . $_FILES['img']['error'];
    }
}
