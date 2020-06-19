<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Blog;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        $blog = Blog::all();
        return view('paginas.admin', array("admins" => $admins, "blog" => $blog));
    }
    public function show($id)
    {
        $admins = Admin::where('id', $id)->get();
        $blog = Blog::all();
        if (\count($admins) > 0) {
            return \view('paginas.admin', array('status' => 200, 'admins' => $admins, "blog" => $blog));
        } else {
            return \view('paginas.admin', array('status' => 404, "admins" => $admins, "blog" => $blog));
        }
    }
    public function update($id, Request $request)
    {
        $datos = array(
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "rol" => $request->input("rol"),
            "contrasena_actual" => $request->input('contrasena_actual'),
            "foto_actual" => $request->input('foto_actual'),
        );
        $password = array("password" => $request->input('password'));
        $foto = array("foto" => $request->file('foto'));

        if ($password['password'] != null) {
            $validar_pas = \Validator::make($password, [
                'password' => ['required', 'string', 'min:8'],
            ]);
            if ($validar_pas->fails()) {
                return \redirect('/admin')->with('password-invalido', "");
            } else {
                if ($password['password'] != $datos['contrasena_actual']) {
                    $password_new = Hash::make($password['password']);
                } else {
                    $password_new = $datos['contrasena_actual'];
                }

            }
        } else {
            $password_new = $datos['contrasena_actual'];
        }
        if ($foto['foto'] != null) {
            $img_validar = \Validator::make($foto, [
                "foto" => 'required|image|mimes:jpg,jpeg,png|max:2000000',
            ]);

            if ($img_validar->fails()) {
                return \redirect('/admin')->with('img-invalido', "");
            } else {
                $aleatoria = \mt_rand(10, 99);
                $foto_new = "img/admin/" . $aleatoria . "." . $foto['foto']->guessExtension();
                \move_uploaded_file($foto['foto'], $foto_new);
                if ($datos['foto_actual'] != "img/admin/default.png") {
                    \unlink($datos['foto_actual']);
                }
            }
        } else {
            $foto_new = $datos['foto_actual'];
        }

        if (!empty($datos)) {
            $validar_user = \Validator::make($datos, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'rol' => ['required'],
                'contrasena_actual' => ['required', 'string', 'min:8'],
                'foto_actual' => ['required'],
            ]);
            // dd($datos);
            if ($validar_user->fails()) {
                return \redirect('/admin')->with("datos-invalidos", "");

            } else {
                $user = array(
                    "name" => $datos['name'],
                    "email" => $datos['email'],
                    "password" => $password_new,
                    "rol" => $datos["rol"],
                    "foto" => $foto_new,
                );
                if (User::where("id", $id)->update($user) > 0) {
                    return \redirect('/admin')->with("success", "");

                } else {
                    return \redirect('/admin')->with("error", "");

                }
            }

        } else {
            return \redirect('/admin')->with("datos-vacios", "");
        }
    }
}
