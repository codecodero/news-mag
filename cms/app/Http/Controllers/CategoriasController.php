<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Blog;
use App\Admin;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        // $categorias = Categorias::all();
        $blog  = Blog::all();
        $admin = Admin::all();
        // return view("paginas.categorias", array("categorias" => $categorias, "blog" => $blog, "admin" => $admin));

        if (request()->ajax()) {
            return datatables()->of(Categorias::all())
                ->addColumn('palabras_claves', function ($data) {
                    $tags = json_decode($data->palabras_claves, true);

                    $p_claves = '';
                    $badges   = array("badge-primary", "badge-secondary", "badge-success", "badge-info", "badge-warning", "badge-dark", "badge-danger");
                    $i        = 0;
                    foreach ($tags as $key => $value) {
                        $p_claves .= '<a href="#" class="badge ' . $badges[$i] . '">' . $value . '</a> ';
                        if ($i == 6) {
                            $i = 0;
                        } else {

                            $i++;
                        }
                    }
                    $p_claves .= '';
                    return $p_claves;

                })
                ->addColumn('acciones', function ($data) {
                    $acciones = '<a href="' . url()->current() . '/' . $data->id . '" class="btn btn-outline-info btn-sm">
                <i class="fas fa-edit"></i>
                </a> |
                <a href="#" class="btn btn-outline-danger btn-sm btn-eliminar-cat" data-action="' . url()->current() . '/' . $data->id . '" data-token="' . csrf_token() . '">
                <i class="fas fa-trash"></i>
                </a>';
                    return $acciones;
                })
                ->rawColumns(['palabras_claves', 'acciones'])
                ->make(true);
        }
        return view('paginas.categorias', array("blog" => $blog, "admin" => $admin));
    }
    public function store(Request $request)
    {
        $datos = array(
            'categoria'       => $request->input("categoria"),
            'descripcion'     => $request->input("descripcion"),
            'palabras_claves' => $request->input("palabras_claves"),
            'ruta'            => $request->input("ruta"),
            "img"             => $request->file("foto"),
        );

        if (!empty($datos['img'])) {
            $img = self::subir_imgen_servidor($datos['img'], "img/categorias/categoria", 1200, 764);
        } else {
            return redirect("/categorias")->with("categoria-img", "");
        }

        if (!empty($datos)) {

            $validar_datos = \Validator::make($datos, [
                "categoria"       => ['required', 'string', 'max:20'],
                "descripcion"     => ['required', 'string', 'max:30'],
                "palabras_claves" => 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "ruta"            => 'required|regex:/^[-\\0-9a-z]+$/i',
                "img"             => "required|image|mimes:jpg,jpeg,png|max:2000000",
            ]);
            if ($validar_datos->fails()) {
                return redirect('/categorias')->with("categoria-error", "");
            } else {

                $categoria                  = new Categorias();
                $categoria->categoria       = $datos['categoria'];
                $categoria->descripcion     = $datos['descripcion'];
                $categoria->palabras_claves = json_encode(explode(',', $datos['palabras_claves']));
                $categoria->ruta            = $datos['ruta'];
                $categoria->img             = $img;
                if ($categoria->save() > 0) {
                    return redirect('/categorias')->with("success-categoria", "");
                } else {
                    return redirect('/')->with("error-categoria", "");
                }
            }
        }
    }

    public function show($id)
    {
        $categoria = Categorias::where("id", $id)->get();
        $admin     = Admin::all();
        $blog      = Blog::all();
        if (count($categoria) > 0) {
            return view('paginas.categorias', array("status" => 200, "categoria" => $categoria, "admin" => $admin, "blog" => $blog));
        } else {
            return view('paginas.categorias', array("status" => 400, "admin" => $admin, "blog" => $blog));
        }
    }
    public function update($id, Request $request)
    {
        $datos = array(
            'categoria'       => $request->input("categoria"),
            'descripcion'     => $request->input("descripcion"),
            'palabras_claves' => $request->input("palabras_claves"),
            'ruta'            => $request->input("ruta"),
            "img"             => $request->input("img_actual"),
        );

        $foto = array('img' => $request->file("foto"));

        if ($foto['img'] != null) {
            $validar_img = \Validator::make($foto, [
                "img" => "required|image|mimes:jpg,jpeg,png|max:2000000",
            ]);
            if ($validar_img->fails()) {
                return redirect("/categorias")->with("categoria-img", "");
            } else {
                $img = self::subir_imgen_servidor($foto['img'], "img/categorias/categoria", 1200, 764);
                if ($datos['img'] != "img/categorias/default.png") {
                    unlink($datos['img']);
                }
            }
        } else {
            $img = $datos['img'];
        }

        if (!empty($datos)) {
            $validar_datos = \Validator::make($datos, [
                "categoria"       => ['required', 'string', 'max:20'],
                "descripcion"     => ['required', 'string', 'max:30'],
                "palabras_claves" => 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "ruta"            => 'required|regex:/^[-\\0-9a-z]+$/i',
                "img"             => ['required', 'string'],
            ]);
            if ($validar_datos->fails()) {
                return redirect("/categorias")->with("categoria-error", "");
            } else {
                $categoria = array(
                    'categoria'       => $datos['categoria'],
                    "descripcion"     => $datos['descripcion'],
                    "palabras_claves" => json_encode(explode(",", $datos['palabras_claves'])),
                    "ruta"            => $datos['ruta'],
                    "img"             => $img);
                if (Categorias::where("id", $id)->update($categoria) > 0) {
                    return redirect('/categorias')->with("success-update", "");
                } else {
                    return redirect('/')->with("error-update-cat", "");
                }
            }
        } else {
            return redirect("/categorias")->with("vacio-update", "");
        }
    }
    public function subir_imgen_servidor($foto, $ruta, $ancho_nuevo = 1200, $alto_nuevo = 764)
    {
        $aletoria                    = mt_rand(1, 999);
        $img                         = $ruta . $aletoria . "." . $foto->guessExtension();
        list($ancho_org, $alto_orig) = getimagesize($foto);
        if ($foto->guessExtension() == 'jpeg') {
            $img_old = imagecreatefromjpeg($foto);
            $img_new = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
            imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $ancho_org, $alto_orig);
            imagejpeg($img_new, $img);
        }
        if ($foto->guessExtension() == "png") {
            $img_old = imagecreatefrompng($foto);
            $img_new = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
            imagealphablending($img_new, false);
            imagesavealpha($img_new, true);
            imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $ancho_org, $alto_orig);
            imagepng($img_new, $img);
        }
        return $img;
    }

    public function destroy($id, Request $request)
    {
        $validar_cat = Categorias::where("id", $id)->get();
        if (!empty($validar_cat)) {
            if ($validar_cat[0]['img'] != "img/categorias/default.png") {
                unlink($validar_cat[0]['img']);
            }
            if (Categorias::where('id', $validar_cat[0]['id'])->delete() > 0) {
                return "ok";
            }
        } else {
            return redirect('/categorias')->with("error_eliminar_cat", "");
        }
    }

}
