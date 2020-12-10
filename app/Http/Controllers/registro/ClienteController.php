<?php

namespace App\Http\Controllers\registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cliente = Cliente::orderby('idcliente','desc')->get();
      return ['cliente' => $cliente];
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
    if ($cliente = Cliente::where('cli_docnum',$request->cli_docnum)->exists()) {
      return ['res' => "si"];
    }else {
      $cliente = new Cliente();
      $cliente->cli_doc = $request->cli_doc;
      $cliente->cli_docnum = $request->cli_docnum;
      $cliente->cli_nombre = $request->cli_nombre;
      $cliente->cli_razon = $request->cli_razon;
      $cliente->cli_pais = $request->cli_pais;
      $cliente->cli_departamento = $request->cli_departamento;
      $cliente->cli_provincia = $request->cli_provincia;
      $cliente->cli_distrito = $request->cli_distrito;
      $cliente->cli_direccion = $request->cli_direccion;
      $cliente->cli_telefono = $request->cli_telefono;
      $cliente->cli_email = $request->cli_email;
      $cliente->cli_web = $request->cli_web;
      $cliente->cli_estado = '1';
      $cliente->save();
      return ['res' => "no"];
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $cliente = Cliente::findOrFail($request->idcliente);
      $cliente->cli_doc = $request->cli_doc;
      $cliente->cli_docnum = $request->cli_docnum;
      $cliente->cli_nombre = $request->cli_nombre;
      $cliente->cli_razon = $request->cli_razon;
      $cliente->cli_pais = $request->cli_pais;
      $cliente->cli_departamento = $request->cli_departamento;
      $cliente->cli_provincia = $request->cli_provincia;
      $cliente->cli_distrito = $request->cli_distrito;
      $cliente->cli_direccion = $request->cli_direccion;
      $cliente->cli_telefono = $request->cli_telefono;
      $cliente->cli_email = $request->cli_email;
      $cliente->cli_web = $request->cli_web;
      $cliente->save();
    }

    public function desactivar(Request $request){
      $cliente = Cliente::findOrFail($request->idcliente);
      $cliente->cli_estado = '0';
      $cliente->save();
    }

    public function activar(Request $request){
      $cliente = Cliente::findOrFail($request->idcliente);
      $cliente->cli_estado = '1';
      $cliente->save();
    }
}
