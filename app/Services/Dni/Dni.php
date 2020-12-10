<?php

namespace App\Services\Dni;

class Dni
{
    public static function search($number)
    {
        $res = Essalud::search($number);
        if ($res['success']) {
            return $res;
        }else {
          return $res;
        }

    }
}
