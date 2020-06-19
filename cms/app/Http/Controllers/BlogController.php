<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::all();

        return view("paginas.blog", array("blog" => $blog));
    }
    public function update($id, Request $request)
    {
        $datos = array(
            "icono_actual" => $request->input("icono_actual"),
            "logo_actual" => $request->input("logo_actual"),
            "portada_actual" => $request->input("portada_actual"),
            "img_info_actual" => $request->input("img_info_actual"),
            "titulo_sitio" => $request->input("titulo_sitio"),
            "dominio" => $request->input("dominio"),
            "cms" => $request->input("cms"),
            "descripcion" => $request->input("descripcion"),
            "palabras_claves" => $request->input("palabras_claves"),
            "redes_sociales" => $request->input("redes_sociales"),
            "info" => $request->input("info"),
        );
        $imagenes = array(
            "icono_tem" => $request->file("icono"),
            "logo_tem" => $request->file("logo"),
            "portada_tem" => $request->file("portada"),
            "img_info_tem" => $request->file("img_info"),
        );

        if (!empty($datos)) {
            $validar = \Validator::make(
                $datos,
                [
                    "icono_actual" => 'required',
                    "logo_actual" => 'required',
                    "portada_actual" => 'required',
                    "img_info_actual" => 'required',
                    "titulo_sitio" => 'required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                    "dominio" => 'required|regex:/^[-\\_\\:\\.\\0-9a-z]+$/i',
                    "cms" => 'required|regex:/^[-\\_\\:\\.\\0-9a-z]+$/i',
                    "descripcion" => 'required|regex:/^[=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                    "palabras_claves" => 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                    "redes_sociales" => 'required',
                    "info" => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',

                ]);
            if ($validar->fails()) {
                return redirect("/blog")->with("error-validation", "");
            } else {
                if (!empty($imagenes['icono_tem'])) {
                    $validacion_img_icono = \Validator::make($imagenes, [
                        "icono_tem" => "required|image|mimes:jpg,jpeg,png|max:2000000",
                    ]);
                    if ($validacion_img_icono->fails()) {
                        return redirect('/blog')->with("img-error", "");
                    } else {
                        if (file_exists($datos['icono_actual'])) {
                            unlink($datos['icono_actual']);
                        }
                        $aletoria = mt_rand(1, 999);
                        $icono = "img/blog/icono" . $aletoria . "." . $imagenes['icono_tem']->guessExtension();
                        // move_uploaded_file($imagenes['icono_tem'], $icono);
                        list($ancho_original, $alto_original) = \getimagesize($imagenes['icono_tem']);
                        $nuevo_ancho = 150;
                        $nuevo_alto = 150;
                        if ($imagenes['icono_tem']->guessExtension() == "jpeg") {
                            $origen = \imagecreatefromjpeg($imagenes['icono_tem']);
                            $destino = \imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                            \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);
                            \imagejpeg($destino, $icono);
                        }
                        if ($imagenes['icono_tem']->guessExtension() == "png") {
                            $origen = \imagecreatefrompng($imagenes['icono_tem']);
                            $destino = \imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                            imagealphablending($destino, false);
                            imagesavealpha($destino, true);
                            \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);
                            \imagepng($destino, $icono);
                        }

                    }
                } else {
                    $icono = $datos['icono_actual'];
                }
                if (!empty($imagenes['logo_tem'])) {
                    $validacion_img_logo = \Validator::make($imagenes, [
                        "logo_tem" => "required|image|mimes:jpg,jpeg,png|max:2000000",
                    ]);
                    if ($validacion_img_logo->fails()) {
                        return redirect('/blog')->with("img-error", "");
                    } else {
                        if (file_exists($datos['logo_actual'])) {
                            unlink($datos['logo_actual']);
                        }
                        $aletoria = mt_rand(1, 999);
                        $logo = "img/blog/logo" . $aletoria . "." . $imagenes['logo_tem']->guessExtension();
                        // move_uploaded_file($imagenes['logo_tem'], $logo);
                        list($ancho_original, $alto_original) = \getimagesize($imagenes['logo_tem']);
                        $nuevo_ancho = 700;
                        $nuevo_alto = 200;
                        if ($imagenes['logo_tem']->guessExtension() == "jpeg") {
                            $origen = \imagecreatefromjpeg($imagenes['logo_tem']);
                            $destino = \imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                            \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);
                            \imagejpeg($destino, $logo);
                        }
                        if ($imagenes['logo_tem']->guessExtension() == "png") {
                            $origen = \imagecreatefrompng($imagenes['logo_tem']);
                            $destino = \imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                            imagealphablending($destino, false);
                            imagesavealpha($destino, true);
                            \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);
                            \imagepng($destino, $logo);
                        }

                    }

                } else {
                    $logo = $datos['logo_actual'];

                }

                if (!empty($imagenes['portada_tem'])) {
                    $validacion_img_portada = \Validator::make($imagenes, [
                        "portada_tem" => "required|image|mimes:jpg,jpeg,png|max:2000000",
                    ]);
                    if ($validacion_img_portada->fails()) {
                        return redirect('/blog')->with("img-error", "");
                    } else {
                        if (file_exists($datos['portada_actual'])) {
                            unlink($datos['portada_actual']);
                        }
                        $aletoria = mt_rand(1, 999);
                        $portada = "img/blog/portada" . $aletoria . "." . $imagenes['portada_tem']->guessExtension();
                        // move_uploaded_file($imagenes['portada_tem'], $portada);
                        list($ancho_original, $alto_original) = \getimagesize($imagenes['portada_tem']);
                        $nuevo_ancho = 700;
                        $nuevo_alto = 420;
                        if ($imagenes['portada_tem']->guessExtension() == "jpeg") {
                            $origen = \imagecreatefromjpeg($imagenes['portada_tem']);
                            $destino = \imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                            \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);
                            \imagejpeg($destino, $portada);
                        }
                        if ($imagenes['portada_tem']->guessExtension() == "png") {
                            $origen = \imagecreatefrompng($imagenes['portada_tem']);
                            $destino = \imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                            imagealphablending($destino, false);
                            imagesavealpha($destino, true);
                            \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);
                            \imagepng($destino, $portada);
                        }

                    }

                } else {
                    $portada = $datos['portada_actual'];

                }

                if (!empty($imagenes['img_info_tem'])) {
                    $validacion_img_info = \Validator::make($imagenes, [
                        "img_info_tem" => "required|image|mimes:jpg,jpeg,png|max:2000000",
                    ]);
                    if ($validacion_img_info->fails()) {
                        return redirect('/blog')->with("img-error", "");
                    } else {
                        if (file_exists($datos['img_info_actual'])) {
                            unlink($datos['img_info_actual']);
                        }
                        $aletoria = mt_rand(1, 999);
                        $img_info = "img/blog/img_info" . $aletoria . "." . $imagenes['img_info_tem']->guessExtension();
                        // move_uploaded_file($imagenes['img_info_tem'], $img_info);
                        list($ancho_original, $alto_original) = \getimagesize($imagenes['img_info_tem']);
                        $nuevo_ancho = 700;
                        $nuevo_alto = 420;
                        if ($imagenes['img_info_tem']->guessExtension() == "jpeg") {
                            $origen = \imagecreatefromjpeg($imagenes['img_info_tem']);
                            $destino = \imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                            \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);
                            \imagejpeg($destino, $img_info);
                        }
                        if ($imagenes['img_info_tem']->guessExtension() == "png") {
                            $origen = \imagecreatefrompng($imagenes['img_info_tem']);
                            $destino = \imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                            imagealphablending($destino, false);
                            imagesavealpha($destino, true);
                            \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);
                            \imagepng($destino, $img_info);
                        }

                    }

                } else {
                    $img_info = $datos['img_info_actual'];

                }

                // $origen = glob('img/temp/*');
                // foreach ($origen as $file) {
                //     copy($file, 'img/blog');
                // }

                $site = array(
                    "icono" => $icono
                    , "logo" => $logo,
                    "portada" => $portada,
                    "titulo" => $datos['titulo_sitio'],
                    "dominio" => $datos["dominio"],
                    "cms" => $datos["cms"],
                    "descripcion" => $datos['descripcion'],
                    "palabras_claves" => json_encode(explode(',', $datos['palabras_claves'])),
                    "redes_sociales" => $datos['redes_sociales'],
                    "sobre_mi" => $datos['info'],
                    "img_sobre_mi" => $img_info,
                );

                if (Blog::where("id", $id)->update($site)) {
                    return redirect("/blog")->with("success-update", "");
                } else {
                    return redirect("/blog")->with("error-update", "");
                }

            }
        } else {
            return redirect("/blog")->with("error-vacio", "");

        }

    }
}
