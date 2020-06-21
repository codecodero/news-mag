<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Blog;
use App\Admin;

class AdsController extends Controller
{
    public function index()
    {
        $ads   = Ads::all();
        $blog  = Blog::all();
        $admin = Admin::all();
        return view('paginas.ads', array("ads" => $ads, "blog" => $blog, "admin" => $admin));
    }
}
