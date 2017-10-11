<?php

namespace App\Http\Controllers\compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\compras\Variacion;
use App\Models\compras\Orden;
class Variaciones extends Controller
{
	public function index($req){
		$variaciones = Variacion::where('estatus', '<>', 2)
								->where('orden_id', $req->orden)
								->get();

		return view('modulos.compras.variaciones', [ 
			'variaciones' => $variaciones , 
			'orden_id' => $req->orden
		]);
	}

	public function crear($req){
		$orden = Orden::find($req->orden);
		return view('modulos.compras.formularios.crear_variacion', [
				'orden' => $orden
			]);
	}


	public function guardar($req){
		$var = new Variacion($req->all());
		if($var->save()){
			return redirect()
					->to( url('index.php/dashboard/compras/variaciones?orden='.$req->orden_id) )
					->with('correcto','LA VARIACION HA SIDO CREADA EXITOSAMENTE');
		}
		else{
			return redirect()
					->to( url('index.php/dashboard/compras/variaciones?orden='.$req->orden_id) )
					->with('error','ERROR AL INTENTAR GUARDAR LA VARIACION');
		}
	}

	public function eliminar($req){
		$var = Variacion::find($req->id);
		$var->estatus = 0;
		if($var->save()){
			return response([
				'error'=> false,
				'mensaje' => 'LA VARIACION HA SIDO ELIMINADA CORRECTAMENTE'
			], 200)->header('Content-Type', 'application/json');
		}else{
			return response([
				'error'=> true,
				'mensaje' => 'HA OCURRIDO UN ERROR AL MOMENTO DE ELIMINAR LA VARIACION'
			], 200)->header('Content-Type', 'application/json');
		}
	}
}
