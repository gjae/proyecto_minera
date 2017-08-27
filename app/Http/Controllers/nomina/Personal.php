<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\personal\Persona;

use DB;
use Carbon\Carbon;

class Personal extends Controller
{
	public function index($req){
		$personas = Persona::all();
		return view('modulos.nomina.index', [
				'personas' => $personas
			]);
	}

	public function formulario($req){
		if( $req->has('form') ){
			$form = \View::make('modulos.nomina.formularios.'.$req->form)->render();
			$data = [
				"error" => false,
				'formulario' => $form
			];

			return response($data, 200)->header('Content-Type', 'application/json');
		}
	}

	/**
	 * FUNCION PARA GUARDAR LOS DATOS DE UNA NUEVA
	 * PERSONA QUE ESTA SIENDO INGRESADA A LA NOMINA
	 */

	public function insertarNuevaPersona($req){
		
		DB::beginTransaction();
		try {
			
			$persona = Persona::where('identificacion', $req->identificacion)->first();

			if( !$persona)
			{
				$persona = new Persona($req->all());
				if( ( new Carbon($persona->fecha_nacimiento) )->diffInYears(Carbon::now()) >= 18 ){
					if( $persona->save() ){
						DB::commit();
						$data = [
							'error' => false,
							'mensaje' => 'El registro ha sido guardado correctamente'
						];
						return response($data, 200)->header('Content-Type', 'application/json');
					}
					else
						throw new \Exception("Error al intentar insertar los datos dentro del modulo nomina, archivo: Personal.php cerca de la linea 39", 1);
						
				}
				throw new \Exception("Error de edad: la persona que intenta ingresar es menor de 18 años, ERROR DENTRO DEL MODULO DE NOMINA, ARCHIVO: Personal.php CERCA DE LA LINEA 39", 1);
			}
			throw new \Exception("Esta identificacion ya se encuentra registrada en la base de datos", 1);
			
			

		} catch (\Exception $e) {
			DB::rollback();
			$data = [
				'error' => true,
				'mensaje' => $e->getMessage()
			];
			return response($data, 200)->header('Content-Type', 'application/json');
		}
	}
}
