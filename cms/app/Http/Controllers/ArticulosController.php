<?php

namespace App\Http\Controllers;

use App\Articulos;
use App\Blog;
use App\Admin;

use Illuminate\Support\Facades\DB;
use App\Categorias;
use Illuminate\Http\Request;

class ArticulosController extends Controller
{
    public function index()
    {
        // $articulos = Articulos::all();
        $blog       = Blog::all();
        $admin      = Admin::all();
        $categorias = Categorias::all();
        // return view('paginas.articulos', array("articulos" => $articulos, "blog" => $blog, "admin" => $admin));

        $join = DB::table('categoria')->join('articulo', 'articulo.id_categoria', '=', 'categoria.id')->select('categoria.*', 'articulo.*')->get();
        if (request()->ajax()) {
            // return datatables()->of(Articulos::all())
            //     ->addColumn('categoria', function ($data) {
            //         $categoria = Categorias::where('id', $data->id_categoria)->get();
            //         return $categoria[0]['categoria'];
            //     })
            return datatables()->of($join)
                ->addColumn('categoria', function ($data) {
                    return $data->categoria;

                })
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
                ->addColumn('contenido', function ($data) {
                    $article_cotent = '<div class="accordion" id="acordion">
                    <div class="card">
                    <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link text-left btn-block" type="button" data-toggle="collapse" data-target="#collapseOne' . $data->id . '" aria-expanded="true" aria-controls="collapseOne' . $data->id . '">
                          Ver el Contenido
                          <i class="float-right fas fa-window-minimize"></i>
                        </button>
                      </h2>
                    </div>

                    <div id="collapseOne' . $data->id . '" class="collapse" aria-labelledby="headingOne" data-parent="#acordion">
                      <div class="card-body">' . $data->contenido . '</div>
                    </div>
                  </div>
                </div>';
                    return $article_cotent;

                })
                ->addColumn('acciones', function ($data) {
                    $acciones = '<a href="' . url()->current() . '/' . $data->id . '" class="btn btn-outline-info btn-sm">
                <i class="fas fa-edit"></i>
                </a> |
                <a href="#" class="btn btn-outline-danger btn-sm btn-eliminar-art" data-action="' . url()->current() . '/' . $data->id . '" data-token="' . csrf_token() . '">
                <i class="fas fa-trash"></i>
                </a>';
                    return $acciones;
                })
                ->rawColumns(['categoria', 'palabras_claves', 'acciones', 'contenido'])
                ->make(true);
        }
        return view('paginas.articulos', array("blog" => $blog, "admin" => $admin, "categorias" => $categorias));
    }

    public function store(Request $request)
    {
        $datos = array(
            "titulo"          => $request->input("titulo"),
            "descripcion"     => $request->input("descripcion"),
            "categoria"       => (int) $request->input("categoria"),
            "ruta"            => $request->input("ruta"),
            "palabras_claves" => $request->input("palabras_claves"),
            "contenido"       => $request->input("contenido"),
            "img"             => $request->file("foto"),
        );

        if (!empty($datos['img'])) {
            $validar_img = \Validator::make($datos, ['img' => 'required|image|mimes:jpg,jpeg,png|max:2000000']);
            if ($validar_img->fails()) {
                return redirect("/articulos")->with("img-no-valido", "");
            } else {
                $carpeta = 'img/articulos/' . $datos['ruta'];
                if (!file_exists($carpeta)) {
                    mkdir($carpeta, 0755);
                }
                $img = self::subir_imagen_servidor($datos['img'], $carpeta . '/', 1200, 764);
            }
        } else {
            return redirect('/articulos')->with("img-vacio", "");
        }

        if (!empty($datos)) {
            $validar_datos = \Validator::make($datos, [
                'titulo'          => ['required', 'string', 'max:50'],
                'descripcion'     => ['required'],
                "categoria"       => ['required'],
                'ruta'            => 'required|regex:/^[-\\0-9a-z]+$/i',
                'palabras_claves' => 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                'contenido'       => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
            ]);

            if ($validar_datos->fails()) {
                return redirect("/articulos")->with("error-datos", "");
            } else {
                $articulo                  = new Articulos();
                $articulo->titulo          = $datos['titulo'];
                $articulo->descripcion     = $datos['descripcion'];
                $articulo->id_categoria    = $datos['categoria'];
                $articulo->ruta            = $datos['ruta'];
                $articulo->palabras_claves = json_encode(explode(',', $datos['palabras_claves']));
                $articulo->contenido       = $datos['contenido'];
                $articulo->img             = $img;
                if ($articulo->save() > 0) {
                    return redirect("/articulos")->with("save-success", "");
                } else {
                    return redirect("/articulos")->with("error-save", "");
                }
            }

        } else {
            return redirect("/articulos")->with("datos-vacios", "");
        }
    }
    public function subir_imagen_servidor($foto, $ruta, $ancho_nuevo = 1200, $alto_nuevo = 764)
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
            $img_new = imagecreatetruecolor($foto);
            imagealphablending($img_new, false);
            imagesavealpha($img_new, true);
            imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $ancho_org, $alto_orig);
            imagepng($img_new, $img);
        }
        return $img;
    }
    public function show($id)
    {
        $articulo   = Articulos::where('id', $id)->get();
        $categorias = Categorias::all();
        $blog       = Blog::all();
        $admin      = Admin::all();
        if (count($articulo) > 0) {
            return view("paginas.articulos", array(
                "status"     => 200,
                "categorias" => $categorias,
                'articulo'   => $articulo,
                'blog'       => $blog,
                'admin'      => $admin,
            ));
        } else {
            return view("paginas.articulos", array(
                "status" => 404,
                'blog'   => $blog,
                'admin'  => $admin,
            ));
        }
    }

    public function update($id, Request $request)
    {
        $datos = array(
            "titulo"          => $request->input("titulo"),
            "descripcion"     => $request->input("descripcion"),
            "categoria"       => (int) $request->input("categoria"),
            "ruta"            => $request->input("ruta"),
            "palabras_claves" => $request->input("palabras_claves"),
            "contenido"       => $request->input("contenido"),
            "img_actual"      => $request->input("img_actual"),
            "img"             => $request->file("foto"),
        );

        if (!empty($datos['img'])) {

            $validar_img = \Validator::make($datos, ['img' => 'required|image|mimes:jpg,jpeg,png|max:2000000']);
            if ($validar_img->fails()) {
                return redirect("/articulos")->with("img-no-valido", "");
            } else {
                $carpeta = 'img/articulos/' . $datos['ruta'];
                $img     = self::subir_imagen_servidor($datos['img'], $carpeta . '/', 1200, 764);
                if ($datos['img_actual'] != "img/articulos/default.png") {
                    unlink($datos['img_actual']);
                }
            }
        } else {
            $img = $datos['img_actual'];
        }

        if (!empty($datos)) {
            $validar_datos = \Validator::make($datos, [
                'titulo'          => ['required', 'string', 'max:50'],
                'descripcion'     => ['required'],
                "categoria"       => ['required'],
                'ruta'            => 'required|regex:/^[-\\0-9a-z]+$/i',
                'palabras_claves' => 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                'contenido'       => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "img_actual"      => 'required',
            ]);
            if ($validar_datos->fails()) {
                // dd($datos);
                return redirect("/articulos")->with("error-datos", "");
            } else {
                $articulo = array(
                    'titulo'          => $datos['titulo'],
                    'descripcion'     => $datos['descripcion'],
                    'id_categoria'    => $datos['categoria'],
                    'ruta'            => $datos['ruta'],
                    'palabras_claves' => json_encode(explode(',', $datos['palabras_claves'])),
                    'contenido'       => $datos['contenido'],
                    'img'             => $img,
                );
                if (Articulos::where('id', $id)->update($articulo) > 0) {
                    return redirect("/articulos")->with("save-success", "");
                } else {
                    return redirect("/articulos")->with("error-save", "");
                }
            }

        } else {
            return redirect("/articulos")->with("datos-vacios", "");
        }
    }
    public function destroy($id, Request $request)
    {
        $validar_art = Articulos::where("id", $id)->get();
        if (!empty($validar_art)) {
            if ($validar_art[0]['img'] != "img/articulos/default.png") {
                unlink($validar_art[0]['img']);
            }
            if (Articulos::where('id', $validar_art[0]['id'])->delete() > 0) {
                return "ok";
            }
        } else {
            return redirect('/articulos')->with("error_eliminar_cat", "");
        }
    }
}
