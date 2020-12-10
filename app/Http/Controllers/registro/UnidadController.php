<?php

namespace App\Http\Controllers\registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unidad;

class UnidadController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $unidad = Unidad::orderby('idunidad','desc')->get();
    return ['unidad' => $unidad];
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
     if ($unidad = Unidad::where('u_nombre',$request->u_nombre)->exists()) {
       return ['res' => "si"];
     }else {
       $unidad = new Unidad();
       $unidad->u_nombre = $request->u_nombre;
       $unidad->u_abre = $request->u_abre;
       $unidad->u_estado = '1';
       $unidad->save();
       return ['res' => "no"];
   }

   }

   public function update(Request $request, $id)
   {
     // if (!$request->ajax()) return redirect('/');
   $unidad = Unidad::findOrFail($request->idunidad);
   $unidad->u_nombre = $request->u_nombre;
   $unidad->u_abre = $request->u_abre;
   $unidad->u_estado = '1';
   $unidad->save();
   }

   public function desactivar(Request $request)
   {
     // if (!$request->ajax()) return redirect('/');
     $unidad = Unidad::findOrFail($request->idunidad);
     $unidad->u_estado = '0';
     $unidad->save();
   }

       public function activar(Request $request)
       {
         // if (!$request->ajax()) return redirect('/');
         $unidad = Unidad::findOrFail($request->idunidad);
         $unidad->u_estado = '1';
         $unidad->save();

       }
       public function destroy(Request $request)
       {
         try {
           $unidad = Unidad::find($request->idunidad);
           $unidad->delete();
           return ['res' => "si"];
         }catch (\Illuminate\Database\QueryException $e){
             return ['res' => "no"];
         }
       }
}
