<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\inventario\TipoMaterial as TM;
class Tipos extends Controller
{
    public function index($req){
    	return view('modulos.configuracion.tipos.index', [
    			'tipos' => TM::where('edo_reg', 1)->get()
    		]);
    }


    public function formularios($req){

    	$vista = \View::make('modulos.configuracion.tipos.formularios.'.$req->form,[
    			'id' => $req->id
    		])->render();

    	$data = [
    		'error' => false,
    		'formulario' => $vista
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');

    }

    public function guardar($req){

    	if( $req->method('post') ){
    		$etapa = new TM($req->all());
    		if($etapa->save()){
    			return response([
    					'error' => false,
    					'mensaje' =>' EL REGISTRO HA SIDO AGREGADO DE MANERA EITOSA'
    				], 200)->header('Content-Type', 'application/json');
    		}
    		return response([
    				'error' => true,
    				'mensaje' => ' ERROR AL INTENTAR ALMACENAR LOS DATOS DE LA NUEVA ETAPA'
    			] ,200)->header('Content-Type', 'application/json');
    	}

    	return redirect()->to(  url('index.php/dashboard/configuracion/etapas'));
    }

    public function editar($req){

    	if( $req->method('post') ){
    		$datos = $req->except(['_token', 'tipo_id']);
    		if( TM::where('id', $req->tipo_id)->update($datos) ){
    			return response([
    					'error' => false,
    					'mensaje' => 'EL REGISTRO HA SIDO ACTUALIZADO DE MANERA CORRECTA'
    				],200)->header('Content-Type' ,'application/json');
    		}
    		return response([
    				'error' => true,
    				'mensaje' => 'ERROR AL INTENTAR ACTUALIZAR LOS DATOS DEL REGISTRO, INTENTE MAS TARDE'
    			],200)->header('Content-Type', 'application/json');

    	}

    	return redirect()->to( url('index.php/dashboard/configuracion/etapas') );

    }

    public function eliminar($req){
    	if( $req->method('post') ){
    		$ep = TM::find($req->id);

    		$ep->edo_reg = 0;
    		if( $ep->save() ){
    			return response([
    					'error' => false,
    					'mensaje' =>'EL REGISTRO SE HA SUPRIMIDO DE MANERA CORRECTA'
    				],200)->header('Content-Type', 'application/json');
    		}
    		return response([
    				'error' => true,
    				'mensaje' => 'EL REGISTRO HA SIDO SUPRIMIDO CORRECTAMENTE'
    			], 200)->header('Content-Type', 'application/json');
    	}

    	return redirect()->to( url('index.php/dashboard/configuracion/etapas') );
    }
}
