<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
  protected $table = 'marca';
  protected $primaryKey = 'idmarca';
  protected $fillable = ['ma_nombre','ma_desc','ma_estado'];
  public $timestamps= false;

 public function productos(){
   return $this->hasMany('App\Producto');
 }
}
