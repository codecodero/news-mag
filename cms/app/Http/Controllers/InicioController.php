<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Admin;

class InicioController extends Controller
{
    public function index()
    {
        $blog  = Blog::all();
        $admin = Admin::all();
        return view("paginas.inicio", array("blog" => $blog, "admin" => $admin));
    }
}
