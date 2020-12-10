<?php

namespace App\Http\Controllers\movimientos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Compra;
use App\Dcompra;
use App\Kardex;
use App\Comprav;

class CompraController extends Controller
{
  public function index(Request $request)
  {
   $compra = Comprav::orderby('idcompra','desc')->get();
   return ['compra' => $compra];
  }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $time = Carbon::now('America/Lima');

        try {
          DB::beginTransaction();

          $compra = new Compra();
          // $compra->com_fecha = $time;
          $compra->com_hora = $time->toTimeString();
          $compra->com_fecha = $time->toDateString();
          // $compra->com_hora = '11:00:00';
          $compra->com_com = $request->comprobante;
          $compra->com_serie = $request->serie;
          $compra->com_numero = $request->numero;
          $compra->com_moneda = $request->moneda;
          // $compra->com_total = '22.3';
          $compra->com_total = $request->total;
          $compra->com_estado = 1;
          $compra->com_femision = $request->emision;
          $compra->com_fvenci = $request->vencimiento;
          // $compra->users_id = \Auth::id();
          $compra->users_id = '8';
          $compra->proveedor_idproveedor = $request->provee;
          // $compra->proveedor_idproveedor = '3';
          $compra->save();

          $detalles = $request->data;

           foreach ($detalles as $ep => $det) {
             $detalle = new Dcompra();
             $detalle ->dc_cantidad = $det['cantidad'];
             $detalle ->dc_precio = $det['precio'];
             $detalle ->dc_lote = $det['lote'];
             $detalle ->dc_fecha = $det['fecha'];
             $detalle ->producto_idproducto = $det['idproducto'];
             $detalle ->compra_idcompra = $compra->idcompra;
             $detalle ->save();
           }

           $kardexs = $request->data;
           foreach ($kardexs as $ep => $det) {
             $kardex = new Kardex();
             $kardex ->ka_fecha = $time->toDateString();
             // $kardex ->ka_fecha = $time->toTimeString();
             $kardex ->ka_tipo = 'Compra';
             $kardex ->ka_cantidad = $det['cantidad'];
             $kardex ->producto_idproducto = $det['idproducto'];
             $kardex ->compra_idcompra = $compra->idcompra;
             // $kardex ->compra_idcompra = '55';
             $kardex ->save();
           }

           //Mz G Lote 14
           //10702166336
           //Direc: Av. Arias Graziani s/n
           //Minimarket 'Estefania'

          DB::commit();
        } catch (\Exception $e) {

          DB::rollBack();
  return ['res' => $detalles];
        }
    }

}
