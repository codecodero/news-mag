<?php
class BlogControler
{

    public static function MostrarBlog()
    {

        $tabla = "blog";

        $blog = BlogModelo::MostrarBlog($tabla);
        return $blog;
    }
    public static function MostrarCategorias()
    {
        $tabla = "categoria";
        $categorias = BlogModelo::MostrarCategorias($tabla);
        return $categorias;
    }

    public static function BuscarArticuloRuta($art_ruta)
    {

        $articulo = BlogModelo::BuscarArticuloRuta($art_ruta);
        return $articulo;
    }
    public static function MostrarOpiones($id_article)
    {
        $comments = BlogModelo::MostrarOpiones($id_article);
        return $comments;
    }
    public static function ActualizarCantidadVistas($id_article, $vista)
    {
        $vista_add = $vista + 1;
        $respuesta = BlogModelo::ActualizarCantidadVistas($id_article, $vista_add);
        return $respuesta;
    }
    public static function MostrarAds($pagina)
    {
        $ads = BlogModelo::MostrarAds($pagina);
        return $ads;
    }
    public static function MostrarBanner($pagina)
    {
        $banners = BlogModelo::MostrarBanner($pagina);
        return $banners;
    }
    public static function GuardarComentario()
    {
        if (isset($_POST['nombre_comment']) && isset($_POST['correo_comment']) && isset($_POST['comment']) && isset($_POST['id_article'])) {
            $name = $_POST['nombre_comment'];
            $email = $_POST['correo_comment'];
            $comment = $_POST['comment'];
            $id_article = $_POST['id_article'];
            if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $name) && preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $comment)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    if (isset($_FILES["foto_comment"]["tmp_name"]) && !empty($_FILES["foto_comment"]["tmp_name"])) {

                        /*=============================================
                        CAPTURAR ANCHO Y ALTO ORIGINAL DE LA IMAGEN Y DEFINIR LOS NUEVOS VALORES
                        =============================================*/

                        list($ancho, $alto) = getimagesize($_FILES["foto_comment"]["tmp_name"]);

                        $nuevoAncho = 128;
                        $nuevoAlto = 128;

                        /*=============================================
                        CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                        =============================================*/

                        $directorio = "vista/img/usuarios/";

                        /*=============================================
                        DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                        =============================================*/

                        if ($_FILES["foto_comment"]["type"] == "image/jpeg") {

                            $aleatorio = mt_rand(100, 9999);

                            $img_user = $directorio . "usuario" . $aleatorio . ".jpg";

                            $origen = imagecreatefromjpeg($_FILES["foto_comment"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagejpeg($destino, $img_user);

                        } else if ($_FILES["foto_comment"]["type"] == "image/png") {

                            $aleatorio = mt_rand(100, 9999);

                            $img_user = $directorio . "usuario" . $aleatorio . ".png";

                            $origen = imagecreatefrompng($_FILES["foto_comment"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagealphablending($destino, false);

                            imagesavealpha($destino, true);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagepng($destino, $img_user);

                        } else {

                            return "error-formato";
                        }

                    } else {

                        $img_user = "vista/img/user02.jpg";
                    }
                    $respuesta = BlogModelo::GuardarComentario($name, $email, $id_article, $comment, $img_user);
                    return $respuesta;
                } else {
                    return "Correo Incorrecto";
                }

            } else {
                return "Datos Incorrectos";
            }
        }
    }
}
