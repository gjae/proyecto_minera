<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Models\personal\Persona;
use App\Models\personal\AjustePersona as AP;
use App\Models\personal\Liquidacion as L;
use PDF;

use App\Models\personal\DetalleLiquidacion as DL;
use DB;

class Liquidacion extends Controller
{

	public function imprimir($req){
		if( $req->has('liquidacion')  && !empty($req->liquidacion) ){
			$meses = [
				'01' => 'Enero',
				'02' => 'Febrero',
				'03' => 'Abril',
				'04' => 'Marzo',
				'05' => 'Mayo',
				'06' => 'Junio',
				'07' => 'Julio',
				'08' => 'Agosto',
				'09' => 'Septiembre',
				'10' => 'Octubre',
				'11' => 'Noviembre',
				'12' => 'Diciembre'
			];
			$liquidacion = L::find($req->liquidacion);
			$vista = \View::make('modulos.nomina.reportes.liquidacion', [
					'liquidacion' => $liquidacion,
					'meses' => $meses
				])->render();

			$pdf = PDF::loadHtml($vista);
			return $pdf->stream('liquidacion_'.$liquidacion->persona->identificaion, ['attachment' => 0]);
		}
	}

    public function procesar($req){
    	$fecha_retiro = Carbon::parse($req->fecha_retiro);
    	$p = Persona::find($req->persona_id);

    	if( $p->estado_persona == 'INACTIVA' ){
    		return redirect()->to( url('dashboard/nomina/personal') )->with('error', 'ESTA PERSONA NO SE ENCUENTRA ACTIVA, NO SE LE PUEDE PROCESAR LA LIQUIDACION O YA POSEE LIQUIDACION');
    	}

    	$dias_trabajados = $fecha_retiro->diffInDays($p->fecha_ingreso);

		list($total_ajustes, $ajustes) = $this->calcularAjustes($req, $p);


		$total_cesantias = Liquidacion::calcularCesantias( ($total_ajustes + $p->sueldo_basico) , $req->dias_liquidacion);

		$intereses_cesantias = Liquidacion::calcularInteresesCesantias( $total_cesantias, $req->porcentaje_intereses, $req->dias_liquidacion );

		$total_prima = Liquidacion::calcularPrima( ($total_ajustes + $p->sueldo_basico), $req->dias_liquidacion );

		$total_vacaciones = Liquidacion::calcularVacaciones($p->sueldo_basico, $req->dias_liquidacion);
		DB::beginTransaction();
		try{
			$datos = [
				'persona_id' => $p->id,
				'dias_trabajados' => $dias_trabajados,
				'fecha_retiro' => $fecha_retiro->format('Y-m-d'),
				'porcentaje_intereses' => $req->porcentaje_intereses,
				'total_cesantias' => $total_cesantias,
				'total_vacaciones' => $total_vacaciones,
				'total_liquidacion' => ( $total_cesantias + $total_vacaciones + $total_prima + $intereses_cesantias ),
				'razon_retiro' => $req->razon_retiro,
				'dias_liquidacion' => $req->dias_liquidacion, 
				'total_prima' => $total_prima

			];
			$liquidacion = new L($datos);
			if( $liquidacion->save() ){

				if(  $this->insertarAjustes($liquidacion, $ajustes, $p, $req)  )
				{	
					$p->estado_persona = 'INACTIVA';
					if( $p->save() )
					{
						DB::commit();
						return redirect()->to( url('dashboard/nomina/personal?persona='.$req->persona_id) )->with('correcto', 'LA LIQUIDACION HA SIDO PROCESADA CORRECTAMENTE');
					}
				}
			}
			throw new \Exception("ERROR AL INTENTAR INSERTAR LOS DATOS", 1);
			
		}catch(\Exception $e){
			DB::rollback();
			return dd($e->getMessage());
			return redirect()->to( url('dashboard/nomina/personal/liquidacion?persola='.$req->persona_id) )->with('error', 'ERROR AL INTENTAR PROCESAR LA LIQUIDACION , INTENTE LUEGO ');
		} 	
    }

    public static function calcularCesantias($base, $dias_trabajados){
    	return ceil(( $base * $dias_trabajados ) / 360);
    }

    public static function calcularInteresesCesantias($cesantia, $porcentaje, $dias){
    	return ceil( ( (($cesantia * $porcentaje) / 100) * $dias ) / 360);
    }

    public static function calcularPrima($total, $dias){
    	return ceil( ($total * $dias) / 360 );
    }

    public static function calcularVacaciones($sueldo_base, $dias){
    	return ceil( ( $sueldo_base  * $dias) /720 );
    }

    private function insertarAjustes($liquidacion, $ajustes, $persona, $req){

    	if( count($ajustes) > 0 )
    	{
	    	foreach ($ajustes as $key => $ajuste) {
	    		$total = 0;
	    		if( $ajuste->ajuste->cantidad_ajuste > 0 ){
	    			$total = ($ajuste->ajuste->tipo_ajuste == 'BONO' )? $total + $ajuste->ajuste->cantidad_ajuste : $total - $ajuste->ajuste->cantidad_ajuste ;
	    		}
	    		else{
	    			$total = ($ajuste->ajuste->tipo_ajuste == 'BONO' ) ? $total +  ( ( $persona->sueldo_basico * $ajuste->ajuste->porcentaje_ajuste ) /100 ) : $total - ( ( $persona->sueldo_basico * $ajuste->ajuste->porcentaje_ajuste ) /100 );
	    		}

	    		$total = ( $total < 0 )? ($total * -1): $total;

	    		$datos = [
	    			'liquidacion_id' => $liquidacion->id,
	    			'ajuste_persona_id' => $ajuste->id,
	    			'total_ajuste' => $total
	    		];
	    		if( !DL::create($datos)){
	    			throw new \Exception("ERROR AL INTENTAR INSERTAR LOS DETALLES DE LOS AJUSTES DE LA LIQUIDACION", 1);
	    			
	    		}
	    	}
	    }
	    return true;
    }

    private function calcularAjustes($req, $persona){

    	$total = 0;
    	$ajustes = [];

    	for ($i=0; $i < count($req->ajustes) ; $i++) { 
    		if( is_numeric($req->ajustes[$i]) || is_integer( $req->ajustes[$i] ) ){
    			$ajuste = AP::where('id', $req->ajustes[$i])
    					->where('persona_id', $req->persona_id)->first();

    			if($ajuste){

    				if($ajuste->ajuste->cantidad_ajuste > 0){
    					$total = ($ajuste->ajuste->tipo_ajuste == 'BONO')? $total + $ajuste->ajuste->cantidad_ajuste: $total;

    					$total = ( $total < 0 )? ($total * -1 ): $total;
    				}else{
    					$total = ($ajuste->ajuste->tipo_ajuste == 'BONO')? $total + ( $persona->sueldo_basico * $ajuste->ajuste->porcentaje_ajuste ) /100 : $total ;

    					$total = ( $total < 0 )? ($total * -1 ): $total;
    				}
    				array_push($ajustes, $ajuste);

    			}// FIN DEL SEGUNDO IF

    		}// FIN DEL PRIMER IF

    	} // FIN DEL CICLO FOR

    	return [$total, $ajustes];
    }
}
