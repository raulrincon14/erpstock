<?php

namespace App\Http\Controllers\registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;
use App\Productov;
use Image;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
       // if (!$request->ajax()) return redirect('/');
      $producto = Productov::orderby('idproducto','desc')->get();
      // $producto =Product
//       $user = App\Models\User::find(1);
//
// $user->first_name = 'Sally';

      // $producto
      return ['producto' => $producto];
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if ($request->pr_cb !== null) {
        if ($cliente = Producto::where('pr_cb',$request->pr_cb)->exists()) {
          return ['res' => "si"];
        }
      }else {

        $maximo = Producto::max('idproducto');
        $maximo = $maximo + 1;
        $maximo = '000000'.$maximo;
        $maximo = substr($maximo,-6);
        $maximo = 'R'.$maximo;


        $producto = new Producto();
        $producto->pr_codi = $maximo;
        // $producto->pr_codi = $request->pr_codi;
        $producto->pr_nombre = $request->pr_nombre;
        $producto->pr_desc = $request->pr_desc;
        $producto->pr_precioc = $request->pr_precioc;
        $producto->pr_preciov = $request->pr_preciov;
        $producto->pr_estado = '1';
        $producto->pr_cb = $request->pr_cb;
        $producto->pr_stkmin = $request->pr_stkmin;
        $producto->pr_stock = '0';
        $producto->pr_medida = $request->pr_medida;
        $producto->pr_igv = $request->pr_igv;
        $producto->pr_lote = $request->pr_lote;
        $producto->pr_serie = $request->pr_serie;
        $producto->categoria_idcategoria = $request->idcategoria;
        $producto->marca_idmarca = $request->idmarca;
        $producto->tipo_idtipo = $request->idtipo;
        $producto->unidad_idunidad = $request->idunidad;
        $producto->save();
        // Cliente::max('id')
        if ($request->imagen) {
          // return ['res' => "no"];
          $Base64Img = $request->imagen;
          $value = $request->imagen;

          // $request = $request->imagen;
          //eliminamos data:image/png; y base64, de la cadena que tenemos
          //hay otras formas de hacerlo
          list(, $Base64Img) = explode(';', $Base64Img);
          list(, $Base64Img) = explode(',', $Base64Img);
          //Decodificamos $Base64Img codificada en base64.
          $Base64Img = base64_decode($Base64Img);
          //escribimos la información obtenida en un archivo llamado
          //unodepiera.png para que se cree la imagen correctamente
          $img = file_put_contents('storage/productos/'.$maximo.'.png', $Base64Img);  // code...
        }

        // echo "<img src='cerveza.png' alt='unodepiera' />";
         return ['res' => "no"];
        //

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
      $producto =  Producto::findOrFail($request->idproducto);

      // $producto->pr_codi = $maximo;
      // $producto->pr_codi = $request->pr_codi;
      $producto->pr_nombre = $request->pr_nombre;
      $producto->pr_desc = $request->pr_desc;
      $producto->pr_precioc = $request->pr_precioc;
      $producto->pr_preciov = $request->pr_preciov;
      // $producto->pr_estado = '1';
      $producto->pr_cb = $request->pr_cb;
      $producto->pr_stkmin = $request->pr_stkmin;
      $producto->pr_medida = $request->pr_medida;
      $producto->pr_igv = $request->pr_igv;
      $producto->pr_lote = $request->pr_lote;
      $producto->pr_serie = $request->pr_serie;
      $producto->categoria_idcategoria = $request->idcategoria;
      $producto->marca_idmarca = $request->idmarca;
      $producto->tipo_idtipo = $request->idtipo;
      $producto->unidad_idunidad = $request->idunidad;
      $producto->save();
      if ($request->imagen) {
        // return ['res' => "no"];
        $Base64Img = $request->imagen;
        $value = $request->imagen;
        $maximo = $request->pr_codi;

        // $request = $request->imagen;
        //eliminamos data:image/png; y base64, de la cadena que tenemos
        //hay otras formas de hacerlo
        list(, $Base64Img) = explode(';', $Base64Img);
        list(, $Base64Img) = explode(',', $Base64Img);
        //Decodificamos $Base64Img codificada en base64.
        $Base64Img = base64_decode($Base64Img);
        //escribimos la información obtenida en un archivo llamado
        //unodepiera.png para que se cree la imagen correctamente
        $img = file_put_contents('storage/productos/'.$maximo.'.png', $Base64Img);  // code...
        return ['maximo' => $maximo];
      }
    }

    public function desactivar(Request $request){
          // if (!$request->ajax()) return redirect('/');
          $producto = Producto::findOrFail($request->idproducto);
          $producto->pr_estado = '0';
          $producto->save();
    }

    public function activar(Request $request){
          // if (!$request->ajax()) return redirect('/');
          $producto = Producto::findOrFail($request->idproducto);
          $producto->pr_estado = '1';
          $producto->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadFile(Request $request)
    {
    if ($request->hasFile('file')) {

        // $company = Company::active();

        $type = $request->input('type');
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $name = 'ejeamplo'.$ext;

        if (($type === 'logo')) request()->validate(['file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024']);

        $file->storeAs(($type === 'logo') ? 'public/uploads/logos' : 'certificates', $name);

        $company->$type = $name;

        $company->save();

        return [
            'success' => true,
            'message' => __('app.actions.upload.success'),
            'name' => $name,
            'type' => $type
        ];
    }
    return [
        'success' => false,
        'message' =>  __('app.actions.upload.error'),
    ];
}

}
