<?php

namespace App\Http\Controllers\utilidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Utilidades extends Controller
{	

    public static function analisis($datos){
    	$comparar = [];

    	$estadisticas = [
    		'forma_pago' => [
    			'CREDITO' => 6,
    			'CONTADO' => 5,
    			'CHEQUE' => 4,
    			'CARTA_DE_CREDITO' => 3,
    			'ABONO_A_CUENTA' => 2,
    			'OTROS' => 1
    		],
    		'terminos_entrega' => [
    			'NUEVO' => 5,
    			'USADO' => 2,
    			'REPARADO' => 1
    		],

    	];
    	foreach ($datos as $key => $dato) {
    		$comparar[$key]['cualitativo'] = 0;
    		
    	}
    	$comparar['cuantitativo'] = 0;
   		/*echo var_dump($datos[1]->registros_cotizacion->sum('total_cotizacion'));
   		exit;*/
    	$ganador = self::getEstadistica($datos, $estadisticas, $comparar);
    	//dd($ganador);
    	
    	return $ganador;
    }

    public static function getEstadistica($datos, $estadisticas, $comparar = []){
    	/**
    	 * CICLO PARA GENERAR ESTADISTICA CUALITATIVA
    	 */
    	foreach ($datos as $key => $dato) {
    		
    		foreach ($dato->registros_cotizacion as $rc) {
    			$comparar[$key]['cualitativo']+= $estadisticas['forma_pago'][$rc->forma_pago];
    			$comparar[$key]['cualitativo'] += $estadisticas['terminos_entrega'][$rc->terminos_entrega];
    		}
    	}	

    	/**
    	 * CICLO PARA GENERAR ANALISIS CUANTITATIVO
    	 */
    	foreach ($datos as $key => $dato) {
    		if( $key == 0 ) {
    			$comparar['cuantitativo'] = $dato;
    		}
    		else if( $key > 0 ){
    			if( $datos[($key - 1)]->registros_cotizacion->sum('total_cotizacion') > $dato->registros_cotizacion->sum('total_cotizacion') )
    			{
    				if( $comparar[($key - 1)]['cualitativo'] > $comparar[$key]['cualitativo'])
    					$comparar['cuantitativo'] = $datos[($key - 1)];

    				else 
    					$comparar['cuantitativo'] = $dato;
    			}
    		}
    	}

    	return $comparar;
    }

    public static function calcular($persona, $total_fraccion_persona){

        $totales = [
            'total_bonos' => 0,
            'total_deducciones' => 0,
            'total_aporte_patron' => 0
        ];
        foreach ($persona->ajustes as $key => $ajuste) {
            if( $ajuste->ajuste->tipo_ajuste == 'BONO' &&  $ajuste->ajuste->ajuste_permanente == 'SI'){

                $totales['total_bonos'] += ( $ajuste->ajuste->porcentaje_ajuste > 0 ) ? ( $total_fraccion_persona * $ajuste->ajuste->porcentaje_ajuste) / 100 : $ajuste->ajuste->cantidad_ajuste;
            }
            else if(($ajuste->ajuste->tipo_ajuste == 'DEDUCCION' && $ajuste->ajuste->aportador != 'PATRON') &&  $ajuste->ajuste->ajuste_permanente == 'SI'){
                $totales['total_deducciones']+= ( $ajuste->ajuste->porcentaje_ajuste > 0 ) ? ( $total_fraccion_persona * $ajuste->ajuste->porcentaje_ajuste) / 100 : $ajuste->ajuste->cantidad_ajuste;
            }
        }

        return $totales;
    }
}
