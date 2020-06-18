<?php

namespace App\Http\Controllers;

use App\Comentarios;

class ComentariosController extends Controller
{
    public function index()
    {
        $comentarios = Comentarios::all();
        return view("paginas.comentarios", array("comentarios" => $comentarios));
    }
}
