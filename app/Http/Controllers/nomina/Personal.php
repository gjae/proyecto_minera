<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\personal\Persona;
use App\Models\personal\Ajuste as A;
use App\Models\personal\AjustePersona as AP;

use Auth;
use DB;
use Carbon\Carbon;
use PDF;

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
			$persona = ( $req->persona == 0 ) ? [] : Persona::find($req->persona)->ajustes()->select('ajuste_id')->get();
			$ids = [];
			foreach ($persona as $key => $ajuste) {
				$ids[$key] = $ajuste->ajuste_id;
			}
			$form = \View::make('modulos.nomina.formularios.'.$req->form, [
					'persona' => Persona::find($req->persona),
					'ids' => $ids,
				])->render();
			$data = [
				"error" => false,
				'formulario' => $form,

			];

			return response($data, 200)->header('Content-Type', 'application/json');
		}
	}

	public function editarPersona($req){
		if(Auth::check() && Auth::user()->tipo_usuario == 'ADMIN'){
			$datos = $req->except(['_token', 'accion', 'persona_id']);
			$datos['fecha_nacimiento'] = Carbon::parse($datos['fecha_nacimiento'])->format('Y-m-d');
			if( DB::table('personas')->where('id', $req->persona_id)->update($datos) ){
				return response([
						'error' => false,
						'mensaje' => 'LOS DATOS DE LA PERSONA HAN SIDO MODIFICADOS CORRECTAMENTE'
					], 200)->header('Content-Type', 'application/json');
			}
		}
		return response([
				'error' => true,
				'mensaje' =>'ERROR AL INTENTAR MODIFICAR LOS DATOS DE LA PERSONA'
			], 200)->header('Content-Type', 'application/json');
	}

	public function reportes($req){
		return call_user_func_array([$this, $req->tipo_formato], [$req]);
	}

	public function listado_personal($req){
		$persona = new Persona;

		//return dd($req->all());
		if( $req->estado != 'T' ){
			//return dd($req->estado);
			$persona= $persona->where('estado_persona', $req->estado);
		}
		if( $req->filtro_cargo != 'T' )
			$persona = $persona->where('cargo_id', $req->filtro_cargo);

		if( !empty($req->fecha_desde))
			$persona = $persona->where('fecha_ingreso', '>=' ,Carbon::parse($req->fecha_desde)->format('Y-m-d') );

		if( !empty($req->fecha_hasta))
			$persona = $persona->where('fecha_ingreso', '<=' ,Carbon::parse($req->fecha_hasta)->format('Y-m-d') );

		$vista = \View::make('modulos.nomina.reportes.listado_personal', [
				'personas' => $persona->get(),
			])->render();
		$pdf = PDF::loadHtml($vista);

		$pdf->setPaper('A4', 'landscape');
		return $pdf->stream('control_personal', ['attachment' => 0]);
	}

	public function loquidacion($req){
		if($req->has('persona') && !empty($req->persona)){
			$p = Persona::find($req->persona);
			if( $p->estado_persona == 'ACTIVA' )
			{
				$data_vista = [
					'persona' => $p
				];
				return view('modulos.nomina.liquidacion', $data_vista);
			}
			else{
			   return redirect()->to( url('index.php/dashboard/nomina/personal') )->with('error', 'ESTA PERSONA NO SE ENCUENTRA ACTIVA, NO SE LE PUEDE PROCESAR LA LIQUIDACION O YA POSEE LIQUIDACION');
			 }
		}
		return redirect()->to( url('index.php/dashboard/nomina/personal') );
	}

	public function guardarAjusteAPersona($req){
		DB::beginTransaction();
		try {
			if( AP::create($req->all()) ){
				DB::commit();
				return response([
						'error' => false,
						'mensaje' => 'SE HA ALMACENADO EL AJUSTE DE MANERA CORRECTA'
					], 200)->header('Content-Type','application/json');
			}
			throw new \Exception("HA OCURRIDO UN ERROR AL INTENTAR ALMACENAR LOS DATOS DEL AJUSTE A LA PERSONA, MODULO: nomina ARCHIVO: Personal.php CERCA DE LA LINEA 48", 1);
			
		} catch (Exception $e) {
			DB::rollback();
			return response([
					'error' => true,
					'mensaje' => $e->getMessage()
				], 200)->header('Content-Type', 'application/json');
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
