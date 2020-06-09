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

    #public static function MostrarArticulos($articulo, $categoria, $cantidad_articulo)
    #{
    #    $con = new Conexion();
    #    $sql = "SELECT a.id,a.id_categoria,c.categoria,a.img,a.titulo,a.descripcion,a.palabras_claves,a.ruta,a.contenido,a.vista,DATE_FORMAT(a.fecha,'%d.%m.%Y') as fecha FROM $articulo a INNER JOIN $categoria c ON c.id = a.id_categoria ORDER BY a.id DESC LIMIT $cantidad_articulo";
    #    $smt = $con->Conectar()->prepare($sql);
    #    $smt->execute();
    #    return $smt->fetchAll();
    #    $stm->close();
    #    $stm->null;
    #}
}
