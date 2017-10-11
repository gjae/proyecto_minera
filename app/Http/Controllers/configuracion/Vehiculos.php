<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\transporte\Vehiculo as V;
class Vehiculos extends Controller
{
    public function index($req){
    	return view('modulos.configuracion.vehiculos.index', [
    			'vehiculos' => V::where('edo_reg', 1)->get()
    		]);
    }

    public function formularios($req){

    	$vista = \View::make('modulos.configuracion.vehiculos.formularios.'.$req->form,[
    			'id' => $req->id
    		])->render();

    	$data = [
    		'error' => false,
    		'formulario' => $vista
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');

    }

    public function editar($req){
    	if( $req->method('post')){
    		$data =  $req->except(['_token', 'vehiculo_id']);
    		if( V::where('id', $req->vehiculo_id)->update($data) ){
    			return response([
    					'error' => false,
    					'mensaje' => 'EL REGISTRO HA SIDO ACTUALIZADO DE MANERA CORRECTA'
    				], 200)->header('Content-Type', 'application/json');
    		}
    		return response([
    				'error' => true,
    				'mensaje' => 'OCURRIO UN ERROR AL INTENTAR ACTUALIZAR LOS DATOS DEL REGISTRO'
    			], 200)->header('Content-Type', 'application/json');
    	}

    	return redirect()->to( url('index.php/dashboard/configuracion/vehiculos') );
    }

    public function eliminar($req){
    	if( $req->method('post') ){
    		if( V::where('id', $req->id)->update(['edo_reg' => 0]) ){
    			return response([
    					'error' => false,
    					'mensaje' => 'EL REGISTRO HA SIDO SUPRIMIDO CORRECTAMENTE'
    				] , 200)->header('Content-Type', 'application/json');
    		}
    	}
    	return redirect()->to( url('index.php/dashboard/configuracion/vehiculos') );
    }

    public function guardar($req){
    	$data = [
    		'error' => true,
    		'mensaje' => 'LOS DATOS HAN LLEGADO AL CONTROLADOR'
    	];

    	if($req->method('post')){
    		$v = new V($req->all());
    		if($v->save()){
    			return response([
    				'error' => false,
    				'mensaje' => 'EL REGISTRO HA SIDO GUARDADO DE MANERA CORRECTA EN EL SISTEMA'
    				],200)->header('Content-Type', 'application/json');
    		}
    		return response([
    				'error' => true,
    				'mensaje' => 'ERROR AL INTENTAR ALMACENAR LOS DATOS EN LA BASE DE DATOS'
    			], 200)->header('Content-Type', 'application/json');
    	}

    	return redirect()->to( url('index.php/dashboard/configuracion/vehiculos') ); 
    }

}
