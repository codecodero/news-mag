<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Banner;
use App\Blog;
use Illuminate\Http\Request;
class BannerController extends Controller
{
    public function index()
    {
        // $banners = Banner::all();
        $blog  = Blog::all();
        $admin = Admin::all();
        if (request()->ajax()) {
            return datatables()->of(Banner::all())
                ->addColumn("acciones", function ($data) {
                    $acciones = '<a href="' . url()->current() . '/' . $data->id_banner . '" class="btn btn-outline-info btn-sm">
                <i class="fas fa-edit"></i>
                </a> |
                <a href="#" class="btn btn-outline-danger btn-sm btn-eliminar-banner" data-action="' . url()->current() . '/' . $data->id_banner . '" data-token="' . csrf_token() . '">
                <i class="fas fa-trash"></i>
                </a>';
                    return $acciones;
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }
        return view("paginas.banner", array("blog" => $blog, "admin" => $admin));
    }
    public function store(Request $request)
    {
        $datos = array(
            'titulo'      => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'pagina'      => $request->input('pagina'),
            'foto'        => $request->file('foto'),
        );
        // dd();
        if (!empty($datos['foto'])) {
            $validar_img = \Validator::make($datos, [
                'foto' => 'required|image|mimes:jpg,jpeg,png|max:2000000',
            ]);
            if ($validar_img->fails()) {
                return redirect("/banner")->with("img_error", "");
            } else {
                $img = self::subir_imagen_servidor($datos['foto'], "img/banners/", 1200, 430);
            }
        } else {
            return redirect("/banner")->with("img_vacio", "");
        }

        if (!empty($datos)) {
            $validar_datos = \Validator::make($datos, [
                'titulo'      => ['required', 'string', 'max:100'],
                'descripcion' => ['required', 'string', 'max:200'],
                'pagina'      => ['required', 'string', 'max:10'],
            ]);

            if ($validar_datos->fails()) {
                return redirect("/banner")->with("datos_error", "");
            } else {
                $banner                     = new Banner();
                $banner->titulo_banner      = $datos['titulo'];
                $banner->descripcion_banner = $datos['descripcion'];
                $banner->pagina_banner      = $datos['pagina'];
                $banner->img_banner         = $img;

                if ($banner->save() > 0) {
                    return redirect("/banner")->with("save_success", "");
                } else {
                    return redirect("/banner")->with("save_error", "");
                }

            }

        } else {
            return redirect("/banner")->with("datos_vacio", "");
        }
    }
    public function subir_imagen_servidor($foto, $ruta, $ancho_nuevo = 1200, $alto_nuevo = 700)
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

    public function show($id)
    {
        $admin = Admin::all();
        $blog  = Blog::all();

        $banner = Banner::where('id_banner', $id)->get();

        if (count($banner) > 0) {
            return view('paginas.banner', array('status' => 200, 'admin' => $admin, 'blog' => $blog, 'banner' => $banner[0]));
        } else {
            return view('paginas.banner', array('status' => 404, 'admin' => $admin, 'blog' => $blog));
        }
    }
    public function destroy($id, Request $request)
    {
        $banner = Banner::where('id_banner', $id)->get();
        if (!empty($banner)) {
            if ($banner[0]['img_banner'] != 'img/banners/defaul.jpg') {
                unlink($banner[0]['img_banner']);
            }
            if (Banner::where('id_banner', $banner[0]['id_banner'])->delete() > 0) {
                return 'ok';
            } else {
                return 'error';
            }
        } else {
            return redirect("/banner")->with("delete_error", "");
        }

    }
    public function update($id, Request $request)
    {
        $datos = array(
            'titulo'      => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'pagina'      => $request->input('pagina'),
            'foto'        => $request->file('foto'),
            'img_actual'  => $request->input('img_actual'),
        );

        if (!empty($datos['foto'])) {
            $validar_img = \Validator::make($datos, [
                'foto' => 'required|image|mimes:jpg,jpeg,png|max:2000000',
            ]);
            if ($validar_img->fails()) {
                return redirect("/banner")->with("img_error", "");
            } else {
                $img = self::subir_imagen_servidor($datos['foto'], "img/banners/", 1200, 430);
                unlink($datos['img_actual']);
            }
        } else {
            $img = $datos['img_actual'];
        }

        if (!empty($datos)) {
            $validar_datos = \Validator::make($datos, [
                'titulo'      => ['required', 'string', 'max:100'],
                'descripcion' => ['required', 'string', 'max:200'],
                'pagina'      => ['required', 'string', 'max:10'],
                'img_actual'  => ['required', 'string'],
            ]);

            if ($validar_datos->fails()) {
                // dd($datos);
                return redirect("/banner")->with("datos_error", "");
            } else {
                $banner = array(
                    'titulo_banner'      => $datos['titulo'],
                    'descripcion_banner' => $datos['descripcion'],
                    'pagina_banner'      => $datos['pagina'],
                    'img_banner'         => $img,
                );

                if (Banner::where('id_banner', $id)->update($banner) > 0) {
                    return redirect("/banner")->with("save_success", "");
                } else {
                    return redirect("/banner")->with("save_error", "");
                }

            }

        } else {
            return redirect("/banner")->with("datos_vacio", "");
        }
    }
}
