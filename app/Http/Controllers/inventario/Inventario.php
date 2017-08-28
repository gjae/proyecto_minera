<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\inventario\Material;
use DB;

class Inventario extends Controller
{
    public function index(){
    	return view('modulos.inventario.index');
    }

    public function formularios($req){
    	if( $req->has('formulario') ){
    		$vista = \View::make('modulos.inventario.formularios.'.$req->formulario)->render();
    		$data = [
    			'error' => false,
    			'formulario' => $vista
    		];
    		return response($data, 200)->header('Content-Type', 'application/json');
    	}
    }

    /**
     * FUNCION QUE GUARDA LAS UNIDADES DE MEDIDA
     */

    /**
     * FUNCION PARA GUARDAR LOS DATOS DE UN MATERIAL
     */
    public function guardarMaterial($req){
    	DB::beginTransaction();
    	$resp = [];
    	try {
    		$material = new Material($req->all());
    		if(! Material::where('codigo_material', $req->codigo_material)->first())
    		{
	    		if($material->save()){
	    			DB::commit();
	    			$resp = [
	    				'error' => false,
	    				'mensaje' => 'EL DATO SE HA GUARDADO DE MANERA CORRECTA'
	    			];
	    		}
	    	}
	    	else
	    		throw new \Exception("EL CODIGO QUE INTENTA GUARDAR YA EXISTE, PRUEBA OTRO. ", 1);
	    		
    	} catch (\Exception $e) {
    		DB::rollback();
    		$resp = [
    			'error' => true,
    			'mensaje' => 'HA OCURRIDO UN ERROR INESPERADO: '.$e->getMessage().' MODULO DE INVENTARIO ARCHIVO Inventario.php'
    		];
    	}finally{
    		return response($resp, 200)->header('Content-Type', 'application/json');
    	}
    }
}
