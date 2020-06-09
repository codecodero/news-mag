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

    #public static function MostrarArticulos($cantidad_art)
    #{
    #    $articulo = "articulo";
    #    $categoria = "categoria";
    #    $articulos = BlogModelo::MostrarArticulos($articulo, $categoria, $cantidad_art);
    #    return $articulos;
    #}
}
