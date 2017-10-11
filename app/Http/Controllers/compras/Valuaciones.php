<?php

namespace App\Http\Controllers\compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\compras\Valuacion;
use App\Models\compras\Orden;

use DB;

class Valuaciones extends Controller
{
	public function index($req){
		$valuaciones = Valuacion::where('orden_id', $req->orden)
								->where('estatus', '<>', 'AN')->get();

		return view('modulos.compras.valuaciones', [ 
			'valuaciones' => $valuaciones , 
			'orden_id' => $req->orden
		]);
	}

	public function crear($req){
		$orden = Orden::find($req->orden);
		return view('modulos.compras.formularios.crear_valuacion', [
				'orden' => $orden
			]);
	}

	public function guardar($req){
		$valuacion = new Valuacion($req->all());
		//return dd($req->all());
		if($valuacion->save()){
			return redirect()
					->to( url('index.php/dashboard/compras/Valuaciones?orden='.$req->orden_id) )
					->with('correcto',  'EL REGISTRO HA SIDO INCLUIDO CORRECTAMENTE');
		}
		else{
			return redirect()
					->to( url('index.php/dashboard/compras/Valuaciones?orden='.$req->orden_id) )
					->with('error', 'EL REGISTRO NO PUDO SER GUARDADO EN LA BASE DE DATOS , INTENTELO MAS TARDE!');
		}
	}

	public function eliminar($req){
		$valuacion = Valuacion::find($req->id);
		$valuacion->estatus = 'AN';

		if( $valuacion->save() ){
			return response([
					'error' => false,
					'mensaje' => 'REGISTRO ANULADO CORRECTAMENTE'
				], 200)->header('Content-Type', 'application/json');
		}else{
			return response([
				'error' => false,
				'mensaje' => 'HA OCURRIDO UN ERROR AL INTENTAR SUPRIMIR EL REGISTRO'

			], 200)->header('Content-Type','application/json');
		}
	}
}
