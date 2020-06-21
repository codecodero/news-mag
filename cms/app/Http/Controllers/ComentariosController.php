<?php

namespace App\Http\Controllers;

use App\Comentarios;
use App\Blog;
use App\Admin;

class ComentariosController extends Controller
{
    public function index()
    {
        $comentarios = Comentarios::all();
        $blog        = Blog::all();
        $admin       = Admin::all();
        return view("paginas.comentarios", array("comentarios" => $comentarios, "blog" => $blog, "admin" => $admin));
    }
}
