<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\minas\MaterialMina as MM;
use App\Models\minas\MovimientosMinas as MOVM;
use App\Models\Mina;
use PDF;
use Carbon\Carbon;
use DB;
use App\Models\inventario\UnidadMedida;
use App\Models\personal\Persona;

class Minas extends Controller
{
    public function index($req){
    	return view('modulos.inventario.minas');
    }

    public function formatoNomina($req){
      $personas = new Persona;
      $personas2 = null;
      $movimientos = null;
      if( $req->has('cedula') && !empty( $req->cedula )  ){
        $personas = $personas->where('identificacion', '=', $req->cedula)->first();
      }
      $personas2 = clone $personas;

      $movimientos = $personas2->mis_movimientos_minas();
      if( $req->has('fecha_desde') && !empty($req->fecha_desde) ){
        $movimientos = $movimientos->where('fecha_ingreso', '>=', $req->fecha_desde);
       // return $movimientos->toSql();
      }
      if( $req->has('fecha_hasta') && !empty($req->fecha_hasta) ){
        $movimientos = $movimientos->where('fecha_ingreso', '<=', $req->fecha_hasta);
      }

      if( empty($req->cedula) ){
        $personas = $personas->where('estado_persona', '=', 'ACTIVA')->get();

        $html = view('modulos.nomina.reportes.reporte_mina_general', [
          'personas' => $personas,
          'fecha_desde' => ( empty($req->fecha_desde) ? null : $req->fecha_desde ),
          'fecha_hasta' => ( empty($req->fecha_hasta) ? null : $req->fecha_hasta ),
          'material' => $req->material_id
        ])->render();

        $pdf = PDF::loadHtml($html);

        $pdfName = md5( Carbon::now()->format('YYYY-mm-dd H:m:s') );

        return $pdf->stream($pdfName, ['stream' => 0]);
        return $html;
      }

      $movimientos = is_null( $movimientos ) ? $movimientos->where('material_mina_id','=', $req->material_id)->orderBy('fecha_ingreso', 'ASC')->get() : $movimientos->where('material_mina_id','=', $req->material_id)->orderBy('fecha_ingreso', 'ASC')->get();

      return dd($movimientos);
      $html = view('modulos.nomina.reportes.reporte_mina_persona', [
        'persona' => $personas,
        'movimientos' => $movimientos,
        'fecha_desde' => ( empty($req->fecha_desde) ? null : $req->fecha_desde ),
        'fecha_hasta' => ( empty($req->fecha_hasta) ? null : $req->fecha_hasta )
      ])->render();

      $pdf = PDF::loadHtml($html);

      $pdfName = md5( Carbon::now()->format('YYYY-mm-dd H:m:s') );

      return $pdf->stream($pdfName, ['stream' => 0]);
    }

    public function guardarUnidadMedida($req){
        $resp = [];
        DB::beginTransaction();
        try {
                if(UnidadMedida::create($req->all())){
                        $resp = [
                                'error' => false,
                                'mensaje' => 'SE HA GUARDADO CORRECTAMENTE LA UNIDAD DE MEDIDA'
                        ];
                        DB::commit();
                }
        } catch (\Exception $e) {
                DB::rollback();
                $resp = [
                        'error' => true,
                        'mensaje' => 'HA OCURRIDO UN ERROR INESPERADO: '.$e->getMessage().' MODULO DE INVENTARIO ARCHIVO Medidas.php FUNCION guardar'
                ];
        }finally{
                return response($resp, 200)->header('Content-Type', 'application/json');

        }
    }


    public function formularios($req){
    	if( $req->has('formulario') ){
    		$vista = \View::make('modulos.inventario.formularios.'.$req->formulario, [
              'id'=> $req->id,
              'ref' => 'minas',
              'desde_form' => 'nomina'
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
                            \Carbon\Carbon::parse($req->fecha_desde)->format('Y-m-d') 
                          ); 
                        $sql->orWhere(
                          'movimientos_materiales.fecha_salida', '>=', 
                          \Carbon\Carbon::parse($req->fecha_desde)->format('Y-m-d') 
                        );

            });

        }
        if($req->has('fecha_hasta') && !empty($req->fecha_hasta)){

            if( !($req->has('fecha_desde') && !empty($req->fecha_desde)) )
              $material = $material->join('movimientos_materiales', 'movimientos_materiales.material_mina_id', 'materiales_minas.id');

            $material = $material->where(function($sql) use ($req){
                          $sql->where( 
                            'movimientos_materiales.fecha_ingreso', '<=', 
                            \Carbon\Carbon::parse($req->fecha_hasta)->format('Y-m-d')     
                        );

                        $sql->orWhere(
                            'movimientos_materiales.fecha_salida', '<=', 
                            \Carbon\Carbon::parse($req->fecha_hasta)->format('Y-m-d') 
                        );

              });
        }

        $mina = new Mina();
	#return dd($material->select('materiales_minas.*')->toSql());
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

        $vista = \View::make('modulos.nomina.reportes.movimientos_minas', [
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
   				'total_movimiento' => $req->total_movimiento,
          'centro_costo_id' => $req->centro_costo_id,
          'diciplina_id' => $req->diciplina_id,
          'etapa_produccion_id' => $req->etapa_produccion_id,


   			];

       // return dd($datos);
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
