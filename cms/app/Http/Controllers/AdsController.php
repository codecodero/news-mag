<?php

namespace App\Http\Controllers;

use App\Ads;

class AdsController extends Controller
{
    public function index()
    {
        $ads = Ads::all();
        return view('paginas.ads', array("ads" => $ads));
    }
}
