<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Blog;
use App\Admin;
class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $blog    = Blog::all();
        $admin   = Admin::all();
        return view("paginas.banner", array("banners" => $banners, "blog" => $blog, "admin" => $admin));
    }
}
