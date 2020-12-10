<?php

namespace App\Http\Controllers\registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tipo;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $tipo = Tipo::orderby('idtipo','desc')->get();
      return ['tipo' => $tipo];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       if ($tipo = Tipo::where('ti_nombre',$request->ti_nombre)->exists()) {
         return ['res' => "si"];
       }else {
         $tipo = new Tipo();
         $tipo->ti_nombre = $request->ti_nombre;
         $tipo->ti_desc = $request->ti_desc;
         $tipo->ti_estado = '1';
         $tipo->save();
         return ['res' => "no"];
     }

     }

     public function update(Request $request, $id)
     {
       // if (!$request->ajax()) return redirect('/');
     $tipo = Tipo::findOrFail($request->idtipo);
     $tipo->ti_nombre = $request->ti_nombre;
     $tipo->ti_desc = $request->ti_desc;
     $tipo->ti_estado = '1';
     $tipo->save();
     }

     public function desactivar(Request $request)
     {
       // if (!$request->ajax()) return redirect('/');
       $tipo = Tipo::findOrFail($request->idtipo);
       $tipo->ti_estado = '0';
       $tipo->save();
     }

         public function activar(Request $request)
         {
           // if (!$request->ajax()) return redirect('/');
           $tipo = Tipo::findOrFail($request->idtipo);
           $tipo->ti_estado = '1';
           $tipo->save();

         }
         public function destroy(Request $request)
         {
           try {
             $tipo = Tipo::find($request->idtipo);
             $tipo->delete();
             return ['res' => "si"];
           }catch (\Illuminate\Database\QueryException $e){
               return ['res' => "no"];
           }
         }
}
