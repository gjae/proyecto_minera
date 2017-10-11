<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\requisicion\EtapaProduccion as EP;
class Etapas extends Controller
{
	public function index($req){
		return view('modulos.configuracion.etapas.index', [
				"etapas" => EP::where('edo_reg', 1)->get()
			]);
	}


    public function formularios($req){

    	$vista = \View::make('modulos.configuracion.etapas.formularios.'.$req->form,[
    			'id' => $req->id
    		])->render();

    	$data = [
    		'error' => false,
    		'formulario' => $vista
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');

    }

    /**
     * CARGANDO EL ARREGLO DE ESTE ARCHIVO
     
     */
    public function guardar($req){

    	if( $req->method('post') ){
    		$etapa = new EP($req->all());
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

    	return redirect()->to(  url('dashboard/configuracion/etapas'));
    }

    public function editar($req){

    	if( $req->method('post') ){
    		$datos = $req->except(['_token', 'etapa_id']);
    		if( EP::where('id', $req->etapa_id)->update($datos) ){
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

    	return redirect()->to( url('dashboard/configuracion/etapas') );

    }

    public function eliminar($req){
    	if( $req->method('post') ){
    		$ep = EP::find($req->id);

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

    	return redirect()->to( url('dashboard/configuracion/etapas') );
    }
}
