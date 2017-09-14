<?php

namespace App\Http\Controllers\viajes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\transporte\Vehiculo;
use App\Models\transporte\Transporte;

use Carbon\Carbon;
use PDF;

class Registrar extends Controller
{
    public function index($req){
    	return view('modulos.transporte.crear', [
    			'vehiculo' => false
    		]);
    }

    public function registro($req){
        $r = Transporte::all();

        return view('modulos.transporte.registro', [
                'viajes' => $r
            ]);
    }

    public function buscar_vehiculos($req){
    	$formulario = \View::make('modulos.transporte.formularios.listado_vehiculos', [
    			'vehiculos' => Vehiculo::where('edo_reg', 1)->get(),
    		])->render();
    	return response([
    			'error' => false,
    			'formulario' => $formulario
    		],200)->header('Content-Type', 'application/json');
    }

    public function reportes($req){
        return response([
                'error' => false,
                'formulario' => \View::make('modulos.transporte.formularios.reportes')->render(),
            ], 200)->header('Content-Type',' application/json');
    }

    public function cargar_vehiculo($req){

    	if($req->has('id') && !empty($req->id)){
    		return view('modulos.transporte.crear', [
    				'vehiculo' => Vehiculo::find($req->id)
    			]);
    	}
    	return redirect()->to( url('dashboard/viajes/registrar') );
    }

    public function buscar_personas($req){
    	$formulario = \View::make('modulos.transporte.formularios.listado_personas', [
    			'vehiculos' => Vehiculo::where('edo_reg', 1)->get(),
    		])->render();
    	return response([
    			'error' => false,
    			'formulario' => $formulario
    		],200)->header('Content-Type', 'application/json');
    }

    public function guardar($req){
    	if( $req->method('post') ){
    		$t = new Transporte($req->all());
    		if($t->save()){
    			return redirect()->to( url('dashboard/viajes/registrar') )->with('correcto', 'LOS DATOS HAN SIDO ALMACENADOS DE MANERA CORRECTA');
    		}
    		else{
    			return redirect()->to( url('dashboard/viajes/registrar') )->with('error', 'HA OCURRIDO UN ERROR INESPERADO AL INTENTAR ALMACENAR LOS DATOS');
    		}
    	}
    	return redirect()->to( url('dashboard') );
    }

    public function imprimir($req){
        $t = new Transporte;

        if( !empty($req->fecha_desde) )
           $t = $t->where('created_at', '>=', Carbon::parse($req->fecha_desde)->format('Y-m-d').' 00:00:00' );
        if( !empty($req->fecha_hasta) )
           $t = $t->where('created_at', '<=', Carbon::parse($req->fecha_hasta)->format('Y-m-d').' 00:00:00' );

        

        $vista = \View::make('modulos.transporte.reportes.'.$req->tipo_reporte, [
                'transportes' => $t->get()
            ])->render();

        $pdf = PDF::loadHtml($vista);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('reporte_'.$req->tipo_reporte, ['attachment' => 0]);
    } 

    private function viajes($req){

    }
}
