<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
  protected $table = 'compra';
  protected $primaryKey = 'idcompra';
  protected $fillable = ['com_fecha','com_hora','com_com','com_serie','com_numero','com_moneda','com_total','com_estado','com_femision','com_fvenci'];
  public $timestamps= false;

  public function proveedor(){
    return $this->belongsTo('App\Proveedor');
  }

  public function usuario(){
    return $this->belongsTo('App\Usuario');
  }
}
