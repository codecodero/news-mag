<?php

namespace App\Http\Controllers;

use App\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('paginas.admin', array("admins" => $admins));
    }
}
