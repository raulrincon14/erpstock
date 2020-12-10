<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
  protected $table = 'proveedor';
  protected $primaryKey = 'idproveedor';
  protected $fillable = ['pro_doc','pro_docnum','pro_nombre','pro_razon','pro_pais','pro_departamento','pro_provincia','pro_distrito','pro_direccion','pro_telefono','pro_email','pro_web','pro_estado'];
  public $timestamps= false;
  protected $appends = ['pro_prove'];

  function getProProveAttribute(){
    return $this->pro_docnum .'-'. $this->pro_nombre;
  }

  protected $casts = [
      'pro_doc' => 'array',
      'pro_pais' => 'array',
      'pro_departamento' => 'array',
      'pro_provincia' => 'array',
      'pro_distrito' => 'array',
  ];
}
