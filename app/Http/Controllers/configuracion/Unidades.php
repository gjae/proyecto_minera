<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\inventario\UnidadMedida as UM;
class Unidades extends Controller
{
    public function index($req){
    	return view('modulos.configuracion.unidades.index', [
    			'unidades' => UM::where('edo_reg', 1)->get()
    		]);
    }

    public function formularios($req){

    	$vista = \View::make('modulos.configuracion.unidades.formularios.'.$req->form,[
    			'id' => $req->id
    		])->render();

    	$data = [
    		'error' => false,
    		'formulario' => $vista
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');

    }

    public function guardar($req){
    	if( $req->method('post')){
    		$um = new UM($req->all());
    		if($um->save()){
    			return response([
    					'error' => false,
    					'mensaje' => 'EL REGISTRO FUE CORRECTAMENTE INCLUIDO'
    				], 200)->header('Content-Type', 'application/json');
    		}
    		return response([
    				'error' => true,
    				'mensaje' => 'HA OCURRIDO UN ERROR AL INTENTAR INCLUIR EL REGISTRO'
    			], 200)->header('Content-Type','application/json');
    	}

    	return redirect()->to( url('index.php/dashboard/configuracion/unidades') );

    }

    public function editar($req){
    	if( $req->method('post') )
    	{
	    	$datos = $req->except(['_token', 'unidad_id']);
	    	if( UM::where('id', $req->unidad_id)->update($datos) ){
	    		return response( [
	    				'error' => false,
	    				'mensaje' => 'REGISTRO ACTUALIZADO DE MANERA CORRECTA'
	    			], 200)->header('Content-Type', 'application/json');
	    	}
	    	return response([
	    			'error' => false,
	    			'mensaje' => 'HA OCURRIDO UN ERROR AL INTENTAR ACTUALIZAR LOS DATOS DEL REGISTRO'
	    		],200)->header('Content-Type', 'application/json');
	    }

	    return redirect()->to( url('index.php/dashboard/coniguracion/unidades') );
    }

    public function eliminar($req){
    	if( $req->method('post')){

    		$um = UM::find($req->id);
    		$um->edo_reg = 0;
    		if($um->save()){
    			return response([
    					'error' => false,
    					'mensaje' =>'EL REGISTRO HA SIDO SUPRIMIDO CORRECTAMENTE'
    				] ,200)->header('Content-Type', 'application/json');
    		}
    		return response([
    				'error' => true,
    				'mensaje' => 'ERROR AL INTENTAR SUPRIMIR EL REGISTRO'
    			], 200)->header('Content-Type', 'application/json');

    	}
    	return redirect()->to( url('index.php/dashboard/configuracion/unidades') );
    }
}
