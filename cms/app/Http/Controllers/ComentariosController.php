<?php

namespace App\Http\Controllers;

use App\Comentarios;
use App\Blog;

class ComentariosController extends Controller
{
    public function index()
    {
        $comentarios = Comentarios::all();
        $blog   = Blog::all();
        return view("paginas.comentarios", array("comentarios" => $comentarios,"blog" => $blog));
    }
}
