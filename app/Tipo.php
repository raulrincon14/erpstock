<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
  protected $table = 'tipo';
  protected $primaryKey = 'idtipo';
  protected $fillable = ['ti_nombre','ti_desc','ti_estado'];
  public $timestamps= false;

   public function productos(){
     return $this->hasMany('App\Producto');
   }
}
