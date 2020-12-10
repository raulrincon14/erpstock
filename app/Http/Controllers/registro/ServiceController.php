<?php

namespace App\Http\Controllers\registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Departamento;
use App\Provincia;
use App\Distrito;
use App\Services\Ruc\Sunat;
use App\Services\Dni\Dni;
use App\Services\Extras\ExchangeRate;

class ServiceController extends Controller
{
    public function index(){
      echo "Si esta funcionando";
    }
    public function dni($number)
        {
            $res = Dni::search($number);

            return $res;
        }
        public function ruc($number){
          $service = new Sunat();
           $res = $service->get($number);
           if ($res) {
              $idprovincia = Provincia::idByDescription($res->provincia);
                  return [
                      'success' => true,
                      'data' => [
                          'name' => $res->razonSocial,
                          'trade_name' => $res->nombreComercial,
                          'address' => $res->direccion,
                          'phone' => implode(' / ', $res->telefonos),
                          'department' => ($res->departamento),
                          'department_id' => Departamento::idByDescription($res->departamento),
                          'province' => ($res->provincia),
                          'province_id' => $idprovincia,
                          'district' => ($res->distrito),
                          'district_id' => Distrito::idByDescription($res->distrito, $idprovincia),
                      ]
                  ];
           }else {
                 return [
                     'success' => false,
                     'message' => $service->getError()
                 ];
           }
        }
}
