<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table = "articulo";
    public function Categorias()
    {
        return $this->belongsTo('App\Categorias', 'id_categoria', 'id');
    }
}
