<?php
$blog = BlogControler::MostrarBlog();
// define("URL_HOST", $blog['dominio']);
$categorias = BlogControler::MostrarCategorias();

$redes_sociales = "";
$palabras_claves = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
$url_cat = "";
if (isset($_GET['url'])) {
    $validar_meta = "";
    foreach ($categorias as $key => $value) {
        if ($_GET['url'] == $value['ruta']) {
            $url_cat = "categorias";
            // var_dump($palabras_claves);
            break;
        }
    }
    foreach (json_decode($value['palabras_claves'], true) as $key => $clave) {
        $palabras_claves .= $clave . ", ";
    }
    ?>
	<?php if (isset($url_cat) == "categorias"): ?>
	<title><?php echo $blog['titulo'] . " | " . $value['categoria']; ?></title>
	<meta name="title" content="<?php echo $blog['titulo'] . " | " . $value['categoria']; ?>">
	<meta name="keywords" content="<?php echo substr($palabras_claves, 0, -2); ?>">
	<meta name="description" content="<?php echo $value['descripcion']; ?>">
	<?php endif?>
<?php
} else {
    foreach (json_decode($blog['palabras_claves'], true) as $key => $el_clave) {
        $palabras_claves .= $el_clave . ", ";
    }
    ?>
	<title><?php echo $blog['titulo']; ?></title>
	<meta name="title" content="<?php echo $blog['titulo']; ?>">
	<meta name="keywords" content="<?php echo substr($palabras_claves, 0, -2); ?>">
	<meta name="description" content="<?php echo $blog['descripcion']; ?>">
<?php }?>
	<link rel="icon" href="<?php echo $blog['dominio']; ?>vista/img/icono.jpg">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Chewy|Open+Sans:300,400" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo $blog['dominio']; ?>vista/css/plugins/jquery.jdSlider.css">
	<link rel="stylesheet" href="<?php echo $blog['dominio']; ?>vista/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="<?php echo $blog['dominio']; ?>vista/js/plugins/jquery.jdSlider-latest.js"></script>
	<!-- <script src="<?php echo $blog['dominio']; ?>vista/js/plugins/pagination.min.js"></script> -->
	<script src="<?php echo $blog['dominio']; ?>vista/js/plugins/scrollUP.js"></script>
	<script src="<?php echo $blog['dominio']; ?>vista/js/plugins/jquery.easing.js"></script>
</head>
<body>
<?php
include 'paginas/seccion/cabecera.php';
include 'paginas/seccion/redes-sociales.php';
include 'paginas/seccion/buscador-movil.php';
include 'paginas/seccion/menu.php';

if (isset($_GET['url'])) {
    $rutaok = "";
    if (is_numeric($_GET['url'])) {
        $pagina = (int) $_GET['url'];
        $postXpagina = 5;
        PaginacionControl::config($pagina, $postXpagina, null, "SELECT a.id,a.id_categoria,c.categoria,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido,a.vista,DATE_FORMAT(a.fecha,'%d.%m.%Y') as fecha FROM articulo a INNER JOIN categoria c ON c.id = a.id_categoria", 5);

        $datos_pag = PaginacionControl::data();
        if ($datos_pag['error']) {
            include 'paginas/error404.php';
        } else {
            $articulos = PaginacionControl::MostrarFilas("id", "DESC");

            include 'paginas/inicio.php';
        }

    } else {
        foreach ($categorias as $key => $value) {
            if ($_GET['url'] == $value['ruta']) {
                $rutaok = "categorias";
                break;
            }
        }
        if ($rutaok == "categorias") {

            $catg = $_GET['url'];
            $pagina = 1;
            $postXpagina = 5;
            PaginacionControl::config($pagina, $postXpagina, null, "SELECT a.id,a.id_categoria,c.categoria,c.ruta,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido,a.vista,DATE_FORMAT(a.fecha,'%d.%m.%Y') as fecha FROM articulo a INNER JOIN categoria c ON c.id = a.id_categoria WHERE c.ruta='$catg'", 5);
            $dts_pg = PaginacionControl::data();
            if ($dts_pg['error']) {
                include 'paginas/error404.php';
            } else {
                $articulos = PaginacionControl::MostrarFilas("id", "DESC");
                include 'paginas/categoria.php';
            }

        } else {
            include 'paginas/error404.php';

        }
    }

} else {
    $pagina = 1;
    $postXpagina = 5;
    PaginacionControl::config($pagina, $postXpagina, null, "SELECT a.id,a.id_categoria,c.categoria,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido,a.vista,DATE_FORMAT(a.fecha,'%d.%m.%Y') as fecha FROM articulo a INNER JOIN categoria c ON c.id = a.id_categoria", 5);

    $datos_pag = PaginacionControl::data();
    if ($datos_pag['error']) {
        include 'paginas/error404.php';
    } else {
        $articulos = PaginacionControl::MostrarFilas("id", "DESC");

        include 'paginas/inicio.php';
    }

}

include 'paginas/seccion/footer.php';

?>

<script src="<?php echo $blog['dominio']; ?>vista/js/script.js"></script>
</body>
</html>