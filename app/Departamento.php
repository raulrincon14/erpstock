<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
  protected $table = 'departamento';
  protected $primaryKey = 'iddepartamento';
  protected $fillable = ['depa_nombre'];
  public $timestamps= false;

  static function idByDescription($description){
      $department = Departamento::where('depa_nombre', $description)->first();
      if ($department) {
          return $department->iddepartamento;
      }
      return '15';
  }
}
