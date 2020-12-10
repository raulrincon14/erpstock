<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
  protected $table = 'kardex';
  protected $primaryKey = 'idkardex';
  protected $fillable = ['ka_fecha','ka_tipo','ka_cantidad','compra_idcompra','venta_idventa','documento_iddocumento'];
  public $timestamps= false;

  public function producto(){
    return $this->belongsTo('App\Producto');
  }

  // public function compra(){
  //   return $this->belongsTo('App\Compra');
  // }
  //
  // public function venta(){
  //   return $this->belongsTo('App\Venta');
  // }
  //
  // public function documento(){
  //   return $this->belongsTo('App\Documento');
  // }



}
