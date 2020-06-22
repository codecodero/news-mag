<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Blog;
use App\Admin;

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
                        }
                        $i++;
                    }
                    $p_claves .= '';
                    return $p_claves;

                })
                ->addColumn('acciones', function ($data) {
                    $acciones = '<a href="' . url()->current() . '/' . $data->id . '" class="btn btn-outline-info btn-sm">
                <i class="fas fa-edit"></i>
                </a> |
                <a href="#" class="btn btn-outline-danger btn-sm btn-eliminar" data-action="' . url()->current() . '/' . $data->id . '" data-token="' . csrf_token() . '">
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

        $foto = array(
            "img" => $request->file('foto');,
        );

        if (!empty($foto['foto'])) {
            $aletoria                    = mt_rand(1, 999);
            $img                         = "/img/categorias/categoria" . $aletoria . "." . $foto['foto']->guessExtension();
            list($ancho_org, $alto_orig) = getimagesize($foto['foto']);
            $ancho_nuevo                 = 1200;
            $alto_nuevo                  = 764;
            if ($foto['foto']->guessExtension() == 'jpeg') {
                $img_old = imagecreatefromjpeg($foto['foto']);
                $img_new = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
                imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $ancho_org, $alto_orig);
                imagejpeg($img_new, $img);
            }
            if ($foto['foto'] . guessExtension() == "png") {
                $img_old = imagecreatefrompng($foto['foto']);
                $img_new = imagecreatetruecolor($foto['foto']);
                imagealphablending($img_new, false);
                imagesavealpha($img_new, true);
                imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $ancho_org, $alto_orig);
                imagepng($img_new, $img);
            }

        } else {
            return redirect("/categorias")->with("categoria-img", "");
        }

        $datos = array(
            'categoria'       => $request->input("categoria"),
            'descripcion'     => $request->input("descripcion"),
            'palabras_claves' => json_encode((explode(",", $request->input("palabras_claves"))),
                'ruta' => $request->input("ruta"),
                "img"  => $img,
            );

            if (!empty($datos)) {

                $validar_datos = Validar::make($datos, [
                    "categoria"       => ['required', 'string'],
                    "descripcion"     => ['required', 'string'],
                    "palabras_claves" => ['required|regex:/^[=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i'],
                    "ruta"            => 'required|regex:/^[-\\0-9a-z]+$/i',
                    "img"             => "required",
                ]);
                if ($validar_datos->fails()) {
                    return redirect('/categorias')->with("categoria-error", "");
                } else {
                    if (Categorias::store($datos) > 0) {
                        return redirect('/categorias')->with("success-categoria");
                    } else {
                        return redirect('/')->with("error-categoria");
                    }
                }
            }
        }

    }
