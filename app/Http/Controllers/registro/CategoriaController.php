<?php

namespace App\Http\Controllers\registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // if (!$request->ajax()) return redirect('/');
     $categoria = Categoria::orderby('idcategoria','desc')->get();
     return ['categoria' => $categoria];
    }

    public function selectCategoria(Request $request){
      // if (!$request->ajax()) return redirect('/');
      $categoria = Categoria::where('ca_estado','=','1')
      ->select('idcategoria','ca_nombre')->orderBy('idcategoria')->get();
      return ['categoria' => $categoria];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // if (!$request->ajax()) return redirect('/');

      if ($cliente = Categoria::where('ca_nombre',$request->ca_nombre)->exists()) {
        return ['res' => "si"];
      }else {
        $categoria = new Categoria();
        $categoria->ca_nombre = $request->ca_nombre;
        $categoria->ca_desc = $request->ca_desc;
        $categoria->ca_estado = '1';
        $categoria->save();
        return ['res' => "no"];
    }
    }

    public function update(Request $request, $id)
    {
      // if (!$request->ajax()) return redirect('/');
    $categoria = Categoria::findOrFail($request->idcategoria);
    $categoria->ca_nombre = preg_replace("/\s+/", " ", trim($request->ca_nombre));
    $categoria->ca_desc = $request->ca_desc;
    $categoria->ca_estado = '1';
    $categoria->save();
    }

    public function desactivar(Request $request)
      {
        // if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->idcategoria);
        $categoria->ca_estado = '0';
        $categoria->save();
      }

      public function activar(Request $request)
      {
        // if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->idcategoria);
        $categoria->ca_estado = '1';
        $categoria->save();
      }

      public function destroy(Request $request)
      {
        try {
          $categoria = Categoria::find($request->idcategoria);
          $categoria->delete();
          return ['res' => "si"];
        }catch (\Illuminate\Database\QueryException $e){
            return ['res' => "no"];
        }
      }

}
