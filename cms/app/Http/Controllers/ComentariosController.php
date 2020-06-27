<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Blog;
use App\Comentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ComentariosController extends Controller
{
    public function index()
    {
        // $comentarios = Comentarios::all();
        $blog  = Blog::all();
        $admin = Admin::all();
        $join  = DB::table("comentarios")
            ->join("users", "users.id", "=", "comentarios.id_user")
            ->join("articulo", "articulo.id", "=", "comentarios.id_articulo")
            ->select("comentarios.*", "users.*", "articulo.*")->get();

        if (request()->ajax()) {
            return datatables()->of($join)
                ->addColumn("comentario", function ($data) {

                    return substr($data->comentario, 0, 80) . ' <b>...</b>';
                })
                ->addColumn("respuesta", function ($data) {

                    return ($data->respuesta_comentario != null) ? substr($data->respuesta_comentario, 0, 80) . ' <b>...</b>' : '';
                })
                ->addColumn("estado", function ($data) {
                    return ($data->estado == 1) ? '<a href="#" class="badge badge-primary"> Aprovado</a>' : '<a href="#" class="badge badge-warning">Pendiente</a>';
                })
                ->addColumn("acciones", function ($data) {
                    $acciones = '<a href="' . url()->current() . '/' . $data->id_comentario . '" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-edit"></i>
                                </a> |
                                <a href="#" class="btn btn-outline-danger btn-sm btn-eliminar-comentario" data-action="' . url()->current() . '/' . $data->id_comentario . '" data-token="' . csrf_token() . '">
                                <i class="fas fa-trash"></i>
                                </a>';
                    return $acciones;
                })
                ->rawColumns(["comentario", "respuesta", "estado", "acciones"])
                ->make(true);
        }

        return view("paginas.comentarios", array("blog" => $blog, "admin" => $admin));
    }
    public function show($id)
    {
        $admin      = Admin::all();
        $blog       = Blog::all();
        $blog       = Blog::all();
        $admin      = Admin::all();
        $comentario = DB::table("comentarios")
            ->join("articulo", "articulo.id", "=", "comentarios.id_articulo")
            ->join("users", "users.id", "=", "comentarios.id_user")
            ->select("comentarios.*", "articulo.*", "users.*")
            ->where("comentarios.id_comentario", "=", $id)
            ->get();
        if (count($comentario) > 0) {
            return view("paginas.comentarios", array('status' => 200, 'admin' => $admin, 'blog' => $blog, 'comentario' => $comentario[0]));
        } else {
            return view("paginas.comentarios", array('status' => 404, 'admin' => $admin, 'blog' => $blog));
        }

    }
    public function update($id, Request $request)
    {
        $datos = array(
            'estado'    => $request->input('estado'),
            'respuesta' => $request->input('respuesta'),
            'admin'     => $request->input('admin'),
        );

        if ($datos != null) {
            $validar_datos = \Validator::make($datos, [
                'estado' => ['required'],
                'admin'  => ['required'],
            ]);
            if ($validar_datos->fails()) {
                return redirect('/comentarios')->with("datos_error", "");
            } else {
                $fecha      = date('Y-m-d:H:i:s');
                $comentario = array(
                    'estado'               => (int) $datos['estado'],
                    'respuesta_comentario' => ($datos['respuesta'] != null) ? $datos['respuesta'] : null,
                    'id_user'              => (int) $datos['admin'],
                    'fecha_respuesta'      => $fecha,
                );
                if (Comentarios::where('id_comentario', $id)->update($comentario) > 0) {
                    return redirect('/comentarios')->with("comentario_success", "");
                } else {
                    return redirect('/comentarios')->with("comentario_error", "");
                }

            }

        } else {
            return redirect('/comentarios')->with("datos_vacio", "");
        }
    }
    public function destroy($id, Request $request)
    {
        $comentario = Comentarios::where('id_comentario', $id)->get();
        if ($comentario[0]['img_usuario'] != 'img/admin/default.png') {
            unlink($comentario[0]['img_usuario']);
        }

        if (Comentarios::where('id_comentario', $comentario[0]['id_comentario'])->delete() > 0) {
            return 'ok';
        } else {
            return 'error';
        }

    }
}
