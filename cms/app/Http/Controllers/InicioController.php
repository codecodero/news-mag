<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class InicioController extends Controller
{
    public function index()
    {
        $blog=  Blog::all();
    	return view("paginas.inicio", array("blog" => $blog));
    }
}
