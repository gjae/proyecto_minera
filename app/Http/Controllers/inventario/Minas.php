<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\minas\MaterialMina as MM;
use App\Models\minas\MovimientosMinas as MOVM;
use App\Models\Mina;
use PDF;
use Carbon\Carbon;
class Minas extends Controller
{
    public function index($req){
    	return view('modulos.inventario.minas');
    }

    public function formularios($req){
    	if( $req->has('formulario') ){
    		$vista = \View::make('modulos.inventario.formularios.'.$req->formulario, [
              'id'=> $req->id,
              'ref' => 'minas'
            ])->render();
    		$data = [
    			'error' => false,
    			'formulario' => $vista,
    		];
    		return response($data, 200)->header('Content-Type', 'application/json');
    	}
    }

    public function guardarMaterial($req){

     		$mm = new MM($req->all());
     		try {
     			if($mm->save()){
     				return response([
     						'error' => false,
     						'mensaje' => 'EL REGISTRO HA SIDO GUARDADO DE MANERA CORRECTA'
     					], 200)->header('Content-Type', 'application/json');
     			}
     			throw new \Exception("HA OCURRIDO UN ERROR AL INTENTAR GUARDAR EL REGISTRO, CONTACTE A SU ADMINISTRADOR DE SISTEMA", 1);
     			
     		} catch (\Exception $e) {
     			return response(['error' => true, 'mensaje' => $e->getMessage()])
     					->header('Content-Type', 'application/json');
     		}
     }

     public function actividad_en_fechas($req){
        $material = new MM;

        if($req->has('material_id'))
            $material = $material->where('materiales_minas.id', $req->material_id);

        if($req->has('fecha_desde') && !empty($req->fecha_desde))
        {
            $material = $material->join('movimientos_materiales', 'movimientos_materiales.material_mina_id', 'materiales_minas.id')
                      ->where(function($sql) use ($req){
                          $sql->where(
                            'movimientos_materiales.fecha_ingreso', '>=', 
                            \Carbon\Carbon::parse($req->fecha_desde)->format('d-m-Y') 
                          ); 
                        $sql->orWhere(
                          'movimientos_materiales.fecha_salida', '>=', 
                          \Carbon\Carbon::parse($req->fecha_desde)->format('d-m-Y') 
                        );

            });

        }
        if($req->has('fecha_hasta') && !empty($req->fecha_hasta)){

            if( !($req->has('fecha_desde') && !empty($req->fecha_desde)) )
              $material = $material->join('movimientos_materiales', 'movimientos_materiales.material_mina_id', 'materiales_minas.id');

            $material = $material->where(function($sql) use ($req){
                          $sql->where( 
                            'movimientos_materiales.fecha_ingreso', '>=', 
                            \Carbon\Carbon::parse($req->fecha_hasta)->format('d-m-Y')     
                        );

                        $sql->orWhere(
                            'movimientos_materiales.fecha_salida', '>=', 
                            \Carbon\Carbon::parse($req->fecha_hasta)->format('d-m-Y') 
                        );

              });
        }

        $mina = new Mina();

        $vista = \View::make('modulos.reportes.movimientos_minas', [
                    'materiales' =>  $material->select('materiales_minas.*')->distinct()->orderBy('materiales_minas.id')->get(),
                    'minas' => $mina->get(),
                ])->render();

        $pdf = PDF::loadHtml($vista);
        $pdf->setPaper('B5', 'landscape');
        return $pdf->stream('movimientos_'.Carbon::now()->format('d_m_Y'), ['attachment' => 0]);
     }

    public function datos_generales($req){

        $material = new MM;

        if($req->has('material_id'))
            $material = $material->where('id', $req->material_id);

        $mina = new Mina();

        $vista = \View::make('modulos.reportes.movimientos_minas', [
                    'materiales' =>  $material->orderBy('id')->get(),
                    'minas' => $mina->get(),
                ])->render();

        $pdf = PDF::loadHtml($vista);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('movimientos_'.Carbon::now()->format('d_m_Y'), ['attachment' => 0]);
    }
   public function eliminarMaterial($req){
   		$mm = MM::where('id', $req->id)->first();

   		if($mm->movimientos->isEmpty())
   		{
	   		if($mm->delete()){
	   			return response([
	   					'error' => false,
	   					'mensaje' => 'EL REGISTRO HA SIDO ELIMINADO DE MANERA CORRECTA'
	   				], 200)->header('Content-Type', 'application/json');
	   		}
	   	}else{
	   		return response([
	   				'error' => true,
	   				'mensaje' => 'ESTE REGISTRO POSEE MOVIMIENTOS Y POR SEGURIDAD NO PUEDE SER ELIMINADO'
	   			], 200)->header('Content-Type', 'application/json');
	   	}

   		return response([	
   				'error' => true,
   				'mensaje' => 'HA OCURRIDO UN ERROR INESPERADO AL INTENTAR ELIMINAR EL REGISTRO'
   			], 200)->header('Content-Type', 'application/json');
   }


   public function ingresarMaterial($req){

   		try {
   			$datos = [
   				'material_mina_id' => $req->material_mina_id,
   				'fecha_'.$req->tipo_movimiento => $req->fecha,
   				'observacion' => $req->observacion,
   				'persona_id' => $req->persona_id,
   				'mina_id' => $req->mina_id,
   				'peso_en' => $req->peso_en,
   				'monto_tonelada' => $req->monto_tonelada,
   				'cantidad_'.$req->tipo_movimiento => $req->cantidad,
   				'total_movimiento' => $req->total_movimiento

   			];

   			if(MOVM::create($datos)){
   				return response([
   						'error' => false,
   						'mensaje' => 'EL MOVIMIENTO HA SIDO INGRESADO EXITOSAMENTE'
   					], 200)->header('Content-Type', 'application/json');
   			}
   			throw new \Exception("HA OCURRIDO UN ERROR AL INTENTAR INGRESAR LOS DATOS, CONSULTE A SU ADMINISTRADOR DE SISTEMA", 1);
   			
   		} catch (\Exception $e) {
   			return response([
   					'error' => true,
   					'mensaje' => $e->getMessage()
   				], 200)->header('Content-Type', 'application/json');
   		}
   }
}
