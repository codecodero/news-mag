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
}
