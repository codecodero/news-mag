<?php
if (isset($_GET['url'])) {
    $ruta = explode('/', $_GET['url']);
}
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
if (isset($ruta[0])) {
    $validar_meta = "";
    foreach ($categorias as $key => $value) {
        if ($ruta[0] == $value['ruta']) {
            $url_cat = "categorias";
            // var_dump($palabras_claves);
            break;
        }
    }
    foreach (json_decode($value['palabras_claves'], true) as $key => $clave) {
        $palabras_claves .= $clave . ", ";
    }
    ?>
    <?php if (BlogControler::BuscarArticuloRuta($ruta[0])): ?>
    <?php $article = BlogControler::BuscarArticuloRuta($ruta[0]);
    $p_claves_article = '';
    foreach (json_decode($article['palabras_claves'], true) as $item) {
        $p_claves_article .= $item . ", ";
    }
    ?>
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Assumenda mollitia, beatae distinctio quas earum praesentium fuga ut dicta sequi! Officiis, vel atque cumque beatae minima aut perferendis assumenda id repellendus?
    <title><?php echo $article['titulo']; ?></title>
    <meta name="title" content="<?php echo $article['titulo']; ?>">

	<meta name="keywords" content="<?php echo substr($p_claves_article, 0, -2); ?>">
    <meta name="description" content="<?php echo $article['descripcion']; ?>">

    <meta property="og:site_name" content="<?php echo $blog['titulo']; ?>">
    <meta property="og:title" content="<?php echo $article['titulo']; ?>">
    <meta property="og:description" content="<?php echo $article['descripcion']; ?>">
    <meta property="og:type" content="article">
    <meta property="og:image" content="<?php echo $blog['dominio'] . $article['img']; ?>">
    <meta property="og:url" content="<?php echo $blog['dominio'] . $article['ruta']; ?>">

    <?php elseif (isset($url_cat) == "categorias"): ?>

	<title><?php echo $blog['titulo'] . " | " . $value['descripcion']; ?></title>
	<meta name="title" content="<?php echo $blog['titulo'] . " | " . $value['categoria']; ?>">
	<meta name="keywords" content="<?php echo substr($palabras_claves, 0, -2); ?>">
    <meta name="description" content="<?php echo $value['descripcion']; ?>">

    <meta property="og:site_name" content="<?php echo $blog['titulo']; ?>">
    <meta property="og:title" content="<?php echo $blog['titulo'] . " | " . $value['categoria']; ?>">
    <meta property="og:description" content="<?php echo $value['descripcion']; ?>">
    <meta property="og:type" content="article">
    <meta property="og:image" content="<?php echo $blog['dominio'] . $blog['portada']; ?>">
    <meta property="og:url" content="<?php echo $blog['dominio'] . $value['ruta']; ?>">

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

    <meta property="og:site_name" content="<?php echo $blog['titulo']; ?>">
    <meta property="og:title" content="<?php echo $blog['titulo']; ?>">
    <meta property="og:description" content="<?php echo $blog['descripcion']; ?>">
    <meta property="og:type" content="site">
    <meta property="og:image" content="<?php echo $blog['dominio'] . $blog['portada']; ?>">
    <meta property="og:url" content="<?php echo $blog['dominio']; ?>">

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

if (isset($ruta[0])) {
    $rutaok = "";
    if (is_numeric($ruta[0])) {
        $pagina = (int) $ruta[0];
        $postXpagina = 5;
        PaginacionControl::config($pagina, $postXpagina, null, "SELECT a.id,a.id_categoria,c.categoria,c.descripcion as cat_descripcion,c.palabras_claves as palabras_claves_cat,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido,a.vista,DATE_FORMAT(a.fecha,'%d.%m.%Y') as fecha FROM articulo a INNER JOIN categoria c ON c.id = a.id_categoria", 5);

        $datos_pag = PaginacionControl::data();
        if ($datos_pag['error']) {
            include 'paginas/error404.php';
        } else {
            $articulos = PaginacionControl::MostrarFilas("id", "DESC");

            include 'paginas/inicio.php';
        }

    } else {
        foreach ($categorias as $key => $value) {
            if ($ruta[0] == $value['ruta']) {
                $rutaok = "categorias";
                break;
            }
        }
        if (BlogControler::BuscarArticuloRuta($ruta[0])) {
            $articulo = BlogControler::BuscarArticuloRuta($ruta[0]);
            include "paginas/articulo.php";

        } else if ($rutaok == "categorias") {

            $catg = $ruta[0];
            $pagina = (isset($ruta[1])) ? (int) $ruta[1] : 1;

            $postXpagina = 5;
            PaginacionControl::config($pagina, $postXpagina, null, "SELECT a.id,a.id_categoria,c.categoria,c.descripcion as cat_descripcion,c.palabras_claves as palabras_claves_cat,c.ruta,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido,a.vista,DATE_FORMAT(a.fecha,'%d.%m.%Y') as fecha FROM articulo a INNER JOIN categoria c ON c.id = a.id_categoria WHERE c.ruta='$catg'", 5);
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
    PaginacionControl::config($pagina, $postXpagina, null, "SELECT a.id,a.id_categoria,c.categoria,c.descripcion as cat_descripcion,c.palabras_claves as palabras_claves_cat,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido,a.vista,DATE_FORMAT(a.fecha,'%d.%m.%Y') as fecha FROM articulo a INNER JOIN categoria c ON c.id = a.id_categoria", 5);

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