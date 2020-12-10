<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productov extends Model
{
  protected $table = 'vproducto';
  protected $primaryKey = 'idproducto';
  protected $appends = ['pr_completo'];

  function getPrCompletoAttribute(){
    return $this->pr_nombre .' '. $this->pr_medida .' '.$this->u_abre;
  }
}
