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
}
