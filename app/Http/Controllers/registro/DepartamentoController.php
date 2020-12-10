<?php

namespace App\Http\Controllers\registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Departamento;
use App\Provincia;
use App\Distrito;

class DepartamentoController extends Controller
{
  public function Departamentos(Request $request){
      // if (!$request->ajax()) return redirect('/');
      $departamentos = Departamento::all();
          return ['departamentos' => $departamentos];
    }

    public function Provincias(Request $request, $number){
      // if (!$request->ajax()) return redirect('/');
      $provincias = Provincia::where('departamento_iddepartamento',$number)
                    ->get();
      // $categoria = Categoria::where('ca_nombre','like','%'. $buscar .'%')->orderBy('idcategoria')->paginate(10);
          return ['provincias' => $provincias];
    }
    public function Distritos(Request $request, $number){
      // if (!$request->ajax()) return redirect('/');
      $distritos = Distrito::where('provincia_idprovincia',$number)
                    ->get();
      // $categoria = Categoria::where('ca_nombre','like','%'. $buscar .'%')->orderBy('idcategoria')->paginate(10);
          return ['distritos' => $distritos];
    }
}
