<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

use App\Models\requisicion\CentroCosto as CC;

class Centros extends Controller
{
    public function index($req){

    	return view('modulos.configuracion.centros.index', [
    			'centros' => CC::where('edo_reg', 1)->get()
    		]);
    }

    public function formularios($req){

    	$vista = \View::make('modulos.configuracion.centros.formularios.'.$req->form,[
    			'id' => $req->id
    		])->render();

    	$data = [
    		'error' => false,
    		'formulario' => $vista
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');

    }

    public function guardar($req){
    	
    	if( $req->method('post') )
    	{
	    	$centro = new CC($req->all());

	    	if( $centro->save() ){
	    		return response([
	    				'error' => false,
	    				'mensaje' => 'EL REGISTRO HA SIDO INCLUIDO DE MANERA EXITOSA'
	    			],200)->header('Content-Type', 'application/json');
	    	}
	    	return response([
	    			'error' => true,
	    			'mensaje' => 'HA OCURRIDO UN ERROR AL INTENTAR INSERTAR EL REGISTRO , INTENTE LUEGO'
	    		],200)->header('Content-Type', 'application/json');
	    }
	    return redirect()->to( url('index.php/dashboard/configuracion/centros') );


    }


    public function editar($req){

    	if( $req->method('post') )
    	{
	    	$datos = $req->except(['_token', 'centro_id']);

	    	if( CC::where('id', $req->centro_id)->update($datos) ){

	    		return response([
	    				'error' => false,
	    				'mensaje' => ' EL REGISTRO HA SIDO ACTUALIZADO DE MANERA CORRECTA'
	    			], 200)->header('Content-Type', 'application/json');
	    	}
	    	return response([
	    			'error' => true,
	    			'mensaje' => 'ERROR AL INTENTAR EDITAR LOS DATOS DEL CENTRO'
	    		], 200)->header('Content-Type', 'application/json');
	    }
	    return redirect()->to( url('index.php/dashboard/configuracion/centros') );
    }

    public function eliminar($req){

    	if(  $req->method('post') ){
    		$cc = CC::find($req->id);

    		$cc->edo_reg = 0;
    		if($cc->save()){
    			return response([
    					'error' => false,
    					'mensaje' =>' EL REGISTRO HA SIDO SUPRIMIDO DE MANERA EXITOSA'
    				], 200)->header('Content-Type', 'application/json');
    		}
    		return response([
    				'error' => true,
    				'mensaje' =>' ERROR AL INTENTAR SUPRINIR EL REGISTRO'
    			], 200)->header('Content-Type', 'application/json');
    	}
    	return redirect()->to( url('index.php/dashboard/configuraciones/centros') );
    }
}	
