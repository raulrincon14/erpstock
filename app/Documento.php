<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
  protected $table = 'documento';
  protected $primaryKey = 'iddocumento';
  protected $fillable = ['cantidad'];
  public $timestamps= false;
}
