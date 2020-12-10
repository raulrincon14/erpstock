<?php

namespace App\Http\Controllers\registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Marca;

class MarcaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $marca = Marca::orderby('idmarca','desc')->get();
    return ['marca' => $marca];

  }

  public function selectMarca(Request $request){
    // if (!$request->ajax()) return redirect('/');
    $marca = Marca::where('ma_estado','=','1')
    ->select('idmarca','ma_nombre')->orderBy('idmarca')->get();
    return ['marca' => $marca];
  }

  public function store(Request $request)
  {
    if ($marca = Marca::where('ma_nombre',$request->ma_nombre)->exists()) {
      return ['res' => "si"];
    }else {
      $marca = new Marca();
      $marca->ma_nombre = $request->ma_nombre;
      $marca->ma_desc = $request->ma_desc;
      $marca->ma_estado = '1';
      $marca->save();
      return ['res' => "no"];
  }

  }


  public function update(Request $request, $id)
  {
    // if (!$request->ajax()) return redirect('/');
  $marca = Marca::findOrFail($request->idmarca);
  $marca->ma_nombre = $request->ma_nombre;
  $marca->ma_desc = $request->ma_desc;
  $marca->ma_estado = '1';
  $marca->save();
  }

  public function desactivar(Request $request)
      {
        // if (!$request->ajax()) return redirect('/');
        $marca = Marca::findOrFail($request->idmarca);
        $marca->ma_estado = '0';
        $marca->save();

      }

      public function activar(Request $request)
      {
        // if (!$request->ajax()) return redirect('/');
        $marca = Marca::findOrFail($request->idmarca);
        $marca->ma_estado = '1';
        $marca->save();

      }
      public function destroy(Request $request)
      {
        try {
          $marca = Marca::find($request->idmarca);
          $marca->delete();
          return ['res' => "si"];
        }catch (\Illuminate\Database\QueryException $e){
            return ['res' => "no"];
        }
      }
}
