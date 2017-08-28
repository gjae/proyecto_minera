<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\inventario\UnidadMedida;

use DB;

class Medidas extends Controller
{
    public function guardarUnidadMedida($req){
    	$resp = [];
    	DB::beginTransaction();
    	try {
    		if(UnidadMedida::create($req->all())){
    			$resp = [
    				'error' => false,
    				'mensaje' => 'SE HA GUARDADO CORRECTAMENTE LA UNIDAD DE MEDIDA'
    			];
    			DB::commit();
    		}
    	} catch (\Exception $e) {
    		DB::rollback();
    		$resp = [
    			'error' => true,
    			'mensaje' => 'HA OCURRIDO UN ERROR INESPERADO: '.$e->getMessage().' MODULO DE INVENTARIO ARCHIVO Medidas.php FUNCION guardarUnidadMedida CERCA DE LA LINEA 17'
    		];
    	}finally{
    		return response($resp, 200)->header('Content-Type', 'application/json');

    	}
    }
}
