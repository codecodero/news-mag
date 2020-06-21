<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Blog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // $admins = Admin::all();
        // $blog = Blog::all();
        // return view('paginas.admin', array("admins" => $admins, "blog" => $blog));

        if (request()->ajax()) {
            return datatables()->of(Admin::all())
                ->addColumn('acciones', function ($data) {
                    $acciones = '<a href="' . url()->current() . '/' . $data->id . '" class="btn btn-outline-info btn-sm">
                    <i class="fas fa-edit"></i>
                    </a> |
                    <a href="#" class="btn btn-outline-danger btn-sm btn-eliminar" data-action="' . url()->current() . '/' . $data->id . '" data-token="' . csrf_token() . '">
                    <i class="fas fa-trash"></i>
                    </a>';
                    return $acciones;
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }
        $blog  = Blog::all();
        $admin = Admin::all();
        return view('paginas.admin', array("blog" => $blog, "admin" => $admin));

    }
    public function show($id)
    {
        $user  = Admin::where('id', $id)->get();
        $blog  = Blog::all();
        $admin = Admin::all();
        if (count($user) > 0) {
            return view('paginas.admin', array(
                'status' => 200,
                'user'   => $user,
                "blog"   => $blog,
                "admin"  => $admin,
            ));
        } else {
            return view('paginas.admin', array(
                'status' => 404,
                "user"   => $user,
                "blog"   => $blog,
                "admin"  => $admin,
            ));
        }
    }
    public function destroy($id, Request $request)
    {
        $user = Admin::where('id', $id)->get();
        if (!empty($user) && $id != 1) {
            if ($user[0]['foto'] != null) {
                if ($user[0]['foto'] != 'img/admin/default.png') {
                    \unlink($user[0]['foto']);
                }
            }

            if (Admin::where('id', $id)->delete() > 0) {
                // return \redirect("/admin")->with("delete-success", "");
                return "ok";

            } else {
                return "error";
                // return \redirect("/admin")->with("delete-error", "");

            }
        } else {
            return \redirect("/admin")->with("delete-error", "");

        }
    }

    public function update($id, Request $request)
    {
        $datos = array(
            "name"              => $request->input('name'),
            "email"             => $request->input('email'),
            "rol"               => $request->input("rol"),
            "contrasena_actual" => $request->input('contrasena_actual'),
            "foto_actual"       => $request->input('foto_actual'),
        );
        $password = array("password" => $request->input('password'));
        $foto     = array("foto" => $request->file('foto'));

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
                $aleatoria = \mt_rand(10, 999);
                $foto_new  = "img/admin/admin" . $aleatoria . "." . $foto['foto']->guessExtension();
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
                'name'              => ['required', 'string', 'max:255'],
                'email'             => ['required', 'string', 'email', 'max:255'],
                'rol'               => ['required'],
                'contrasena_actual' => ['required', 'string', 'min:8'],
                'foto_actual'       => ['required'],
            ]);
            // dd($datos);
            if ($validar_user->fails()) {
                return \redirect('/admin')->with("datos-invalidos", "");

            } else {
                $user = array(
                    "name"     => $datos['name'],
                    "email"    => $datos['email'],
                    "password" => $password_new,
                    "rol"      => $datos["rol"],
                    "foto"     => $foto_new,
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
