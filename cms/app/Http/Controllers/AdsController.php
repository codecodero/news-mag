<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Ads;
use App\Blog;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index()
    {
        // $ads   = Ads::all();
        $blog  = Blog::all();
        $admin = Admin::all();
        if (request()->ajax()) {
            return datatables()->of(Ads::all())
                ->addColumn("ads", function ($data) {
                    return $data->codigo_anuncio;
                })
                ->addColumn("acciones", function ($data) {
                    $acciones = '<a href="' . url()->current() . '/' . $data->id_ads . '" class="btn btn-outline-info btn-sm">
                <i class="fas fa-edit"></i>
                </a> |
                <a href="#" class="btn btn-outline-danger btn-sm btn_eliminar_ads" data-action="' . url()->current() . '/' . $data->id_ads . '" data-token="' . csrf_token() . '">
                <i class="fas fa-trash"></i>
                </a>';
                    return $acciones;
                })
                ->rawColumns(['ads', 'acciones'])
                ->make(true);
        }
        return view('paginas.ads', array("blog" => $blog, "admin" => $admin));
    }
    public function store(Request $request)
    {
        $datos = array(
            'pagina_ads' => $request->input('pagina_ads'),
            'codigo_ads' => $request->input('codigo_ads'),
        );

        if (!empty($datos)) {
            $validar_datos = \Validator::make($datos, [
                'pagina_ads' => ['required', 'string', 'max:30'],
                'codigo_ads' => ['required', 'regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\{\\}\\[\\]\\/\\|\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i'],
            ]);

            if ($validar_datos->fails()) {
                return redirect("/ads")->with("datos_error", "");
            } else {
                $ads                 = new Ads();
                $ads->pagina_anuncio = $datos['pagina_ads'];
                $ads->codigo_anuncio = $datos['codigo_ads'];
                // dd($ads);
                if ($ads->save() > 0) {
                    return redirect("/ads")->with("save_success", "");
                } else {
                    return redirect("/ads")->with("save_error", "");
                }

            }

        } else {
            return redirect("/ads")->with("datos_vacio", "");
        }
    }
    public function show($id)
    {
        $admin = Admin::all();
        $blog  = Blog::all();

        $ads = Ads::where('id_ads', $id)->get();

        if (count($ads) > 0) {
            return view('paginas.ads', array('status' => 200, 'admin' => $admin, 'blog' => $blog, 'ads' => $ads[0]));
        } else {
            return view('paginas.ads', array('status' => 404, 'admin' => $admin, 'blog' => $blog));
        }
    }
    public function destroy($id, Request $request)
    {
        if (Ads::where('id_ads', $id)->delete() > 0) {
            return 'ok';
        } else {
            return 'error';
        }

    }
    public function update($id, Request $request)
    {
        $datos = array(
            'pagina_ads' => $request->input('pagina_ads'),
            'codigo_ads' => $request->input('codigo_ads'),
        );

        if (!empty($datos)) {
            $validar_datos = \Validator::make($datos, [
                'pagina_ads' => 'required',
                'codigo_ads' => ['required', 'regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\{\\}\\[\\]\\/\\|\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i'],
            ]);

            if ($validar_datos->fails()) {
                return redirect("/ads")->with("datos_error", "");
            } else {
                $ads = array(
                    'pagina_anuncio' => $datos['pagina_ads'],
                    'codigo_anuncio' => $datos['codigo_ads'],
                );

                if (Ads::where('id_ads', $id)->update($ads) > 0) {
                    return redirect("/ads")->with("save_success", "");
                } else {
                    return redirect("/ads")->with("save_error", "");
                }

            }

        } else {
            return redirect("/ads")->with("datos_vacio", "");
        }
    }
}
