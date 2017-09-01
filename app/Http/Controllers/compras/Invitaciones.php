<?php

namespace App\Http\Controllers\compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// MODELOS
// 
use App\Models\compras\SolicitudCotizacion;
use App\Models\compras\Proveedor;

class Invitaciones extends Controller
{
    public function index($req){ 

    	return view('modulos.compras.solicitudes', [
    			'codigo' => $this->getCodigoSolicitud()
    		]);

    }

    private function getCodigoSolicitud(){
    	$codigo = SolicitudCotizacion::max('codigo') + 1;
    	$len = 8 - strlen($codigo);

    	for ($i=0; $i < $len ; $i++) { 
    		$codigo =  '0'.$codigo;
    	}
    	return $codigo;
    }

    public function buscarProveedores($req){
    	$proveedores = Proveedor::all();
    	$vista = \View::make('modulos.compras.formularios.listado_proveedores', [
    			'proveedores' => $proveedores
    		])->render();

    	$data = [
    		'error' => ( count($proveedores) <= 0 ) ? true : false,
    		'mensaje' => ( count($proveedores) <= 0 ) ? 'NO HAY PROVEEDORES REGISTRADOS' : 'PROVEEDORES ENCONTRADOS',
    		'formulario' => $vista,
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');
    }
}
