<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Blog;

class AdsController extends Controller
{
    public function index()
    {
        $ads = Ads::all();
        $blog   = Blog::all();
        return view('paginas.ads', array("ads" => $ads,"blog" => $blog));
    }
}
