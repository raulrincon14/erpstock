<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
  protected $table = 'provincia';
  protected $primaryKey = 'idprovincia';
  protected $fillable = ['vincia_nombre'];
  public $timestamps= false;

  static function idByDescription($description){
      $department = Provincia::where('vincia_nombre', $description)->first();
      if ($department) {
          return $department->idprovincia;
      }
      return '128';
  }
}
