<?php

namespace App\Http\Controllers\registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $proveedor = Proveedor::orderby('idproveedor','desc')->get();
      return ['proveedor' => $proveedor];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if ($proveedor = Proveedor::where('pro_docnum',$request->pro_docnum)->exists()) {
        return ['res' => "si"];
      }else {
        $proveedor = new Proveedor();
        $proveedor->pro_doc = $request->pro_doc;
        $proveedor->pro_docnum = $request->pro_docnum;
        $proveedor->pro_nombre = $request->pro_nombre;
        $proveedor->pro_razon = $request->pro_razon;
        $proveedor->pro_pais = $request->pro_pais;
        $proveedor->pro_departamento = $request->pro_departamento;
        $proveedor->pro_provincia = $request->pro_provincia;
        $proveedor->pro_distrito = $request->pro_distrito;
        $proveedor->pro_direccion = $request->pro_direccion;
        $proveedor->pro_telefono = $request->pro_telefono;
        $proveedor->pro_email = $request->pro_email;
        $proveedor->pro_web = $request->pro_web;
        $proveedor->pro_estado = '1';
        $proveedor->save();
        return ['res' => "no"];
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $proveedor = Proveedor::findOrFail($request->idproveedor);
      $proveedor->pro_doc = $request->pro_doc;
      $proveedor->pro_docnum = $request->pro_docnum;
      $proveedor->pro_nombre = $request->pro_nombre;
      $proveedor->pro_razon = $request->pro_razon;
      $proveedor->pro_pais = $request->pro_pais;
      $proveedor->pro_departamento = $request->pro_departamento;
      $proveedor->pro_provincia = $request->pro_provincia;
      $proveedor->pro_distrito = $request->pro_distrito;
      $proveedor->pro_direccion = $request->pro_direccion;
      $proveedor->pro_telefono = $request->pro_telefono;
      $proveedor->pro_email = $request->pro_email;
      $proveedor->pro_web = $request->pro_web;
      $proveedor->save();
    }

    public function desactivar(Request $request){
      $proveedor = Proveedor::findOrFail($request->idproveedor);
      $proveedor->pro_estado = '0';
      $proveedor->save();
    }

    public function activar(Request $request){
      $proveedor = Proveedor::findOrFail($request->idproveedor);
      $proveedor->pro_estado = '1';
      $proveedor->save();
    }
}
