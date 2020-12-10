<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
  protected $table = 'categoria';
     protected $primaryKey = 'idcategoria';
     protected $fillable = ['ca_nombre','ca_desc','ca_estado'];
     public $timestamps= false;

     public function productos(){
       return $this->hasMany('App\Producto');
     }
}
