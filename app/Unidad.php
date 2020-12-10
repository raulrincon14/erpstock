<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
  protected $table = 'unidad';
  protected $primaryKey = 'idunidad';
  protected $fillable = ['u_nombre','u_abre','u_estado'];
  public $timestamps= false;
  
   public function productos(){
     return $this->hasMany('App\Producto');
   }
}
