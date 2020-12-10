<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $table = 'cliente';
  protected $primaryKey = 'idcliente';
  protected $fillable = ['cli_doc','cli_docnum','cli_nombre','cli_razon','cli_pais','cli_departamento',
  'cli_provincia','cli_distrito','cli_direccion','cli_telefono','cli_email','cli_web','cli_estado'];
  public $timestamps= false;

  protected $casts = [
      'cli_doc' => 'array',
      'cli_pais' => 'array',
      'cli_departamento' => 'array',
      'cli_provincia' => 'array',
      'cli_distrito' => 'array',
  ];
}
