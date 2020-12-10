<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
  protected $table = 'venta';
  protected $primaryKey = 'idventa';
  protected $fillable = ['fecha','hora','estado','numerocom','total'];
  public $timestamps= false;
}
