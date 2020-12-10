<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
  protected $table = 'distrito';
  protected $primaryKey = 'iddistrito';
  protected $fillable = ['distri_nombre','provincia_idprovincia'];
  public $timestamps= false;

  static function idByDescription($description, $province_id)
  {
      $district = Distrito::where('distri_nombre', $description)
                          ->where('provincia_idprovincia', $province_id)
                          ->first();
      if ($district) {
          return $district->iddistrito;
      }
      return '1275';
  }
}
