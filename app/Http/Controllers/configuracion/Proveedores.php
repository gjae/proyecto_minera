<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Models\compras\Proveedor;
class Proveedores extends Controller
{
    public function index($req){
    	$proveedores = Proveedor::where('edo_reg', 1)->get();

    	return view('modulos.configuracion.proveedores.index',[
    			'proveedores' => $proveedores
    		]);
    }

    public function formularios($req){

    	$vista = \View::make('modulos.configuracion.proveedores.formularios.'.$req->form,[
    			'id' => $req->id
    		])->render();

    	$data = [
    		'error' => false,
    		'formulario' => $vista
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');

    }

    public function guardar($req){
    	
    	if($req->method('post'))
    	{
	    	DB::beginTransaction();
	    	try {
	    		
	    		$prov = new Proveedor($req->all());
	    		if($prov->save()){
	    			DB::commit();
	    			return response([
	    					'error' => false,
	    					'mensaje' =>' EL PROVEEDOR HA SIDO REGISTRADO EXITOSAMENTE'
	    				], 200)->header('Content-Type', 'application/json');
	    		}
	    		throw new \Exception("HA OCURRIDO UN ERROR INESPERADO AL INTENTAR INGRESAR LOS DATOS EN LA BASE DE DATOS", 1);
	    		

	    	} catch (\Exception $e) {
	    		DB::rollback();
	    		return response([
	    				'error' => true,
	    				'mensaje' => $e->getMessage(),
	    			], 200)->header('Content-Type','application/json');
	    	}

	    	return response($data, 200)->header('Content-Type',' application/json');
	    }
	    return redirect()->to( url('index.php/dashboard/configuracion/proveedores') );
    }

    public function editar($req){
    	if($req->method('post')){
    		$datos = $req->except(['_token', 'proveedor_id']);
    		DB::beginTransaction();
    		try {
    			
    			if( Proveedor::where('id', $req->proveedor_id)->update($datos) ){
    				DB::commit();
    				return response([
    						'error' => false,
    						'mensaje' => 'EL REGISTRO HA SIDO ACTUALIZADO CORRECTAMENTE'
    					], 200)->header('Content-Type', 'application/json');
    			}
    			throw new \Exception("ERROR AL INTENTAR ACTUALIZAR EL REGISTRO, MODULO DE CONFIGURACION, PROVEEDORES . CERCA DE LA LINEA 73", 1);
    			
    		} catch (\Exception $e) {
    			DB::rollback();
    			return response([
    					'error' => true,
    					'mensaje' => $e->getMessage()
    				], 200)->header('Content-Type', 'application/json');
    		}
    	}
    	return redirect()->to( url('index.php/dashboard/configuracion/proveedores') );
    }

    public function eliminar($req){
    	$proveedor = Proveedor::find($req->id);

    	$proveedor->edo_reg = 0;
    	if($proveedor->save()){
    		return response([
    				'error' => false,
    				'mensaje' => 'REGISTRO SUPRIMIDO SATISFACTORIAMENTE'
    			], 200)->header('Content-Type', 'application/json');
    	}
    	return response([
    			'error' => true,
    			'mensaje' => 'ERROR AL INTENTAR SUPRIMIR EL REGISTRO'
    		], 200)->header('Content-Type', 'application/json');
    }
}
