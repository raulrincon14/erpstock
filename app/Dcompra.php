<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dcompra extends Model
{
  protected $table = 'dcompra';
  protected $fillable = ['dc_cantidad','dc_precio','dc_lote','dc_fecha'];
  public $timestamps= false;

  public function producto(){
    return $this->belongsTo('App\Producto');
  }

  public function Compra(){
    return $this->belongsTo('App\Compra');
  }

}
