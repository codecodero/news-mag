<?php

namespace App\Http\Controllers;

use App\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view("paginas.banner", array("banners" => $banners));
    }
}
