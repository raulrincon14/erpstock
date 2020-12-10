<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $table = 'producto';
  protected $primaryKey = 'idproducto';
  protected $fillable = ['pr_codi','pr_nombre','pr_desc','pr_precioc','pr_preciov','pr_estado','pr_cb','pr_stkmin','pr_stock','pr_medida','pr_igv',
  'pr_lote','pr_serie','categoria_idcategoria','unidad_idunidad','marca_idmarca','tipo_idtipo'];

  public function categoria(){
    return $this->belongsTo('App\Categoria');
  }

  public function marca(){
    return $this->belongsTo('App\Marca');
  }

  public function tipo(){
    return $this->belongsTo('App\Tipo');
  }

  public function unidad(){
    return $this->belongsTo('App\Unidad');
  }
}
