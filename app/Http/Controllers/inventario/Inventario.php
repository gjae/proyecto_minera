<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\inventario\Material;
use App\Models\inventario\IngresoMaterial;
use App\Models\inventario\EgresoMaterial;
use DB;
use PDF;

class Inventario extends Controller
{
    public function index(){
    	return view('modulos.inventario.index');
    }

    public function formularios($req){
    	if( $req->has('formulario') ){
    		$vista = \View::make('modulos.inventario.formularios.'.$req->formulario, ['id'=> $req->id])->render();
    		$data = [
    			'error' => false,
    			'formulario' => $vista,
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


    public function controlBodega($req){
        $materiales = Material::all();
        $vista = \View::make('modulos.inventario.reportes.formato_bodega', [
                'materiales' => $materiales
            ]);

        $pdf = PDF::loadHtml($vista);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('reporte_control_bodega', ['attachment' => 0]);
    }

    public function ingresarMaterial($req){
        $ingreso = new IngresoMaterial($req->all());
        $respuesta = [];
        if( $ingreso->save() ){
            $respuesta = [
                'error' => false,
                'mensaje' => 'Se ha realizado el ingreso correctamente'
            ];
        }
        else{

            $respuesta = [
                'error' => true,
                'mensaje' => 'HA OCURRIDO UN ERROR INESPERADO AL INTENTAR REALIZAR EL INGRESO DE MATERIAL, MODULO DE INVENTARIO ARCHIVO INVENTARIO.PHP'
            ];
        }

        return response($respuesta, 200)->header('Content-Type', 'application/json');
    }

    public function egresarMaterial($req){
        $egreso = new EgresoMaterial($req->all());

        $respuesta = [];
        if( $egreso->save() ){
            $respuesta = [
                'error' => false,
                'mensaje' => 'Se ha realizado el egreso de material correctamente'
            ];    
        }
        else{
            $respuesta = [
                'error' => true,
                'mensaje' => 'HA OCURRIDO UN ERROR INESPERADO AL INTENTAR REALIZAR EL INGRESO DE MATERIAL, MODULO DE INVENTARIO ARCHIVO INVENTARIO.PHP'
            ];         
        }
        return response($respuesta, 200)->header('Content-Type', 'application/json');
    }

    public function eliminarMaterial($req){
        if( $req->has('id') ){
            $data = [];
            DB::beginTransaction();
            try {
                $material = Material::find($req->id);
                $material->estado_material = 'ELIMINADO';
                if($material->save()){
                    DB::commit();
                    $data = [
                        'error' => false,
                        'mensaje' => 'REGISTRO ELIMINADO CORRECTAMENTE'
                    ];

                    return response($data, 200)->header('Content-Type', 'application/json');
                }

            } catch (\Exception $e) {
                DB::rollback();
                $data = [
                    'error' => true,
                    'mensaje' => 'ERROR INESPERADO : '.$e->getMessage()
                ];
                return response($data, 200)->header('Content-Type', 'application/json');
            }
        }
    }

}
