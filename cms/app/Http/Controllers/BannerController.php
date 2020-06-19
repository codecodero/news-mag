<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Blog;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $blog   = Blog::all();
        return view("paginas.banner", array("banners" => $banners,"blog" => $blog));
    }
}
