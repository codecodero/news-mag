<?php
// require_once "bd_config.php";
require_once "conexion.php";

class BlogModelo
{

    public static function MostrarBlog($tabla)
    {
        $con = new Conexion();
        $sql = "SELECT * FROM $tabla";
        $stm = $con->Conectar()->prepare($sql);
        $stm->execute();
        return $stm->fetch();
        $stm->close();
        $stm->null;
    }
    public static function MostrarCategorias($tabla)
    {
        $con = new Conexion();
        $sql = "SELECT * FROM $tabla";
        $stm = $con->Conectar()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
        $stm->close();
        $stm->null;
    }

    public static function BuscarArticuloRuta($art_ruta)
    {
        $con = new Conexion();
        $sql = "SELECT a.id,a.id_categoria,c.categoria,c.descripcion as cat_descripcion,c.palabras_claves as palabras_claves_cat,c.ruta as ruta_cat, c.ruta,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido as contenido,a.vista,DATE_FORMAT(a.fecha,'%d.%m.%Y') as fecha FROM articulo a INNER JOIN categoria c ON c.id = a.id_categoria WHERE a.ruta=:art_ruta";
        $smt = $con->Conectar()->prepare($sql);
        $smt->execute(array(
            ':art_ruta' => $art_ruta,
        ));
        return $smt->fetch();
        $stm->close();
        $stm->null;
    }
    public static function MostrarOpiones($id_article)
    {
        $con = new Conexion();
        $sql = "SELECT comentarios.*,admin.* FROM comentarios INNER JOIN admin ON comentarios.id_admin=admin.id WHERE comentarios.id_articulo=:id_art";
        $smt = $con->Conectar()->prepare($sql);
        $smt->bindParam(":id_art", $id_article, PDO::PARAM_STR);
        $smt->execute();
        return $smt->fetchAll();
        $stm->close();
        $stm->null;
    }
    public static function GuardarComentario($name, $email, $id_article, $comment, $img_user)
    {
        try {
            $con = new Conexion();
            $sql = "INSERT INTO comentarios (nombre_usuario,correo_usuario,img_usuario,comentario,id_articulo) VALUES (:nombre,:correo,:img,:comment,:id_art)";
            $smt = $con->Conectar()->prepare($sql);
            $smt->execute(array(
                ":nombre" => $name,
                ":correo" => $email,
                ":img" => $img_user,
                ":comment" => $comment,
                ":id_art" => $id_article,

            ));
            return 1;
            $stm->close();
            $stm->null;
        } catch (Exeption $e) {

            return "Error en: " . $e->getMessage();
        }

    }
    public static function ActualizarCantidadVistas($id_article, $vista)
    {
        try {
            $con = new Conexion();
            $sql = "UPDATE articulo SET vista=:vistas WHERE id=:id_art";
            $stm = $con->Conectar()->prepare($sql);
            $stm->execute(array(
                ":vistas" => $vista,
                ":id_art" => $id_article,
            ));
            return 1;
            $stm->close();
            $stm->null;
        } catch (Exeption $e) {
            return "Error en: " . $e->getMessage();
        }
    }
    public static function MostrarAds($pagina)
    {
        try {

            $con = new Conexion();
            $sql = "SELECT * FROM ads where pagina_anuncio=:pag";
            $stm = $con->Conectar()->prepare($sql);
            $stm->execute(array(
                ":pag" => $pagina,
            ));
            return $stm->fetchAll();
            $stm->close();
            $stm->null;
        } catch (Exception $e) {
            return "Error en:" . $e->getMessage();
        }
    }
    public static function MostrarBanner($pagina)
    {
        try {
            $con = new Conexion();
            $sql = "SELECT * FROM banner WHERE pagina_banner=:pag";
            $stm = $con->Conectar()->prepare($sql);
            $stm->execute(array(
                ":pag" => $pagina,
            ));
            return $stm->fetchAll();
            $stm->close();
            $stm->null;
        } catch (Exeption $e) {
            return "Error en: " . $e->getMessage();
        }
    }
}
