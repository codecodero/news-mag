<?php

namespace App\Http\Controllers;

use App\Articulos;
use App\Blog;
use App\Admin;
use App\Categorias;

class ArticulosController extends Controller
{
    public function index()
    {
        // $articulos = Articulos::all();
        $blog  = Blog::all();
        $admin = Admin::all();
        // return view('paginas.articulos', array("articulos" => $articulos, "blog" => $blog, "admin" => $admin));
        if (request()->ajax()) {
            return datatables()->of(Articulos::all())
                ->addColumn('categoria', function ($data) {
                    $categoria = Categorias::where('id', $data->id_categoria)->get();
                    return $categoria[0]['categoria'];
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
        return view('paginas.articulos', array("blog" => $blog, "admin" => $admin));
    }
}
