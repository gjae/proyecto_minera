<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\administracion\Banco;
use DB;
class Bancos extends Controller
{
    public function index($req){

    	return view('modulos.configuracion.bancos.index', [
    			'bancos' => Banco::where('edo_reg', 1)->get()
    		]);
    }

    public function formularios($req){
    	$vista = \View::make('modulos.configuracion.bancos.formularios.'.$req->form, [
    			'banco_id' => $req->id
    		])->render();

    	$data = [
    		'error' => false,
    		'formulario' => $vista
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');
    }

    public function editar($req){

    	if( $req->method('post') ){
    		DB::beginTransaction();
    		try {
    			
    			if($req->has('nombre_banco') && $req->nombre_banco != ''){
    				
    				if( Banco::where('id', $req->banco_id)->update($req->except(['_token', 'banco_id'])) ){
    					DB::commit();
    					return response([
    							'error' => false,
    							'mensaje' => 'LOS DATOS HAN SIDO ACTUALIZADOS CORRECTAMENTE'
    						], 200)->header('Content-Type', 'application/json');
    				}
    				throw new \Exception("ERROR AL ACTUALIZAR LOS DATOS DEL REGISRO AL MOMENTO DE GUARDAR LOS CAMBIOS", 1);

    			}
    			throw new \Exception("ERROR AL INTENTAR ACTUALIZAR LOS DATOS DEL REGISTRO, MODULO DE CONFIGURACIONES ARCHIVO CARGOS CERCA DE LA LINEA 78", 1);
    			

    		} catch (\Exception $e) {
    			DB::rollback();
    			return response([
    					'error' => true,
    					'mensaje' => $e->getMessage()
    				] ,200)->header('Content-Type', 'application/json');
    		}
    	}else{
    		return redirect()->to( url('dashboard/configuracion/cargos') );
    	}
    }

    public function eliminar($req){
    	if( $req->method('post') ){

    		if( Banco::where('id', $req->id)->update(['edo_reg' => 0]) ){
    			return response( [
    					'error' => false,
    					'mensaje' => 'EL REGISTRO SE HA SUPRIMNIDO CORRECTAMENTE'
    				],200)->header('Content-Type', 'application/json');
    		}

    	}else{
    		return redirect()->to( url('dashboard/configuracion/cargos') );
    	}
    }

    public function guardar($req){

    	if(!$req->method('post') ){
    		return redirect()->to( url('dashboard/configuracion/bancos') );
    	}
    	DB::beginTransaction();
    	try {
    		
    		if( $req->has('nombre_banco') && $req->nombre_banco != '' ){
    			$cargo = new Banco($req->all());
    			if($cargo->save()){
    				DB::commit();
    				return response([
    						'error' => false,
    						'mensaje' => 'EL CARGO HA SIDO REGISTRADO DE MANERA CORRECTA'
    					], 200)->header('Content-Type', 'application/json');
    			}
    			throw new \Exception("ERROR AL INTENTAR INGRESAR EL REGISTRO EN EL MODULO DE CONIGURACION , PROGRAMA: CARGOS CERCA DE LA LINEA 41", 1);
    			
    		}
    		throw new \Exception("ERROR, FALTAN DATOS POR INGRESAR", 1);
    		

    	} catch (\Exception $e) {
    		DB::rollback();
    		return response([
    				'error' => true,
    				'mensaje' => $e->getMessage()
    			] ,200)->header('Content-Type', 'application/json');
    	}
    }

}
