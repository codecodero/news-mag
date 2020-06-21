<?php

namespace App\Http\Controllers;

use App\Articulos;
use App\Blog;
use App\Admin;

class ArticulosController extends Controller
{
    public function index()
    {
        $articulos = Articulos::all();
        $blog      = Blog::all();
        $admin     = Admin::all();
        return view('paginas.articulos', array("articulos" => $articulos, "blog" => $blog, "admin" => $admin));
    }
}
