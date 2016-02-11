<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\personal\Nomina as N;
use App\Models\personal\Persona as P;
use App\Models\personal\DetalleNomina as DN;
use App\Http\Controllers\utilidades\Utilidades as U;
use App\Models\personal\Ajuste as A;

use DB;
use PDF;
use Carbon\Carbon;
class Nomina extends Controller
{

    public function index($req){
    	return view('modulos.nomina.nominas');
    }

    public function trabajar($req){
    	if( $req->has('codigo_nomina') ){
    		$nomina = N::where('codigo_nomina', $req->codigo_nomina)->first();
    		return view('modulos.nomina.trabajar_nomina', [
    				'nomina' => $nomina,
                    'codigo_nomina' => $req->codigo_nomina,
                    'persona' =>false
    			]);
    	}
    	return redirect()->to( url('dashboard/nomina') );
    }

    public function crearNomina($req){
        $codigo = N::max('codigo_nomina') + 1;
        $len = '';

        for ($i=0; $i < (4 - strlen($codigo)) ; $i++) { 
            $len.= '0';
        }

        $vista = \View::make('modulos.nomina.formularios.abrir_nomina', [
                'codigo' => $len.$codigo
            ])->render();

        return response(['error' => false, 'formulario' => $vista], 200)->header('Content-Type', 'application/json');
    }

    public function buscarPersonas($req){
        $view = \View::make('modulos.nomina.formularios.personas', [
                'personas' => P::all()
            ])->render();

       return response(['error' => false, 'formulario' => $view])->header('Content-Type', 'application/json');
    }

    public function abrirNomina($req){
        DB::beginTransaction();
        try {
            
            $nomina = new N($req->all());
            if($nomina->save()){
                DB::commit();
                return response(['error' => false, 'mensaje' => 'NOMINA CREADA CORRECTAMENTE'], 200)->header('Content-Type' , 'application/json');
            }
            throw new Exception("ERROR AL INTENTAR CREAR LA NOMINA", 1);
            

        } catch (\Exception $e) {
            DB::rollback();
            return response(['error' => true, 'mensaje'=> $e->getMessage()])->header('Content-Type', 'application/json');
        }
    }

    public function trabajarPersona($req){
        if( $req->has('codigo_nomina') && $req->has('persona') ){
            $nomina = N::where('codigo_nomina', $req->codigo_nomina)->first();
            $persona = P::find($req->persona);

            if( $nomina->tipo_nomina == 'Q' )
                $total_fraccion_persona = $persona->sueldo_basico / 2;
            else if($nomina->tipo_nomina == 'S' )
                $total_fraccion_persona = $persona->sueldo_basico / 4;
            else
                $total_fraccion_persona = $persona->sueldo_basico;


            $totales = U::calcular($persona, $total_fraccion_persona);

            return view('modulos.nomina.trabajar_nomina', [
                    'nomina' => $nomina,
                    'codigo_nomina' => $req->codigo_nomina,
                    'persona' => $persona,
                    'total_para_nomina' => $total_fraccion_persona,
                    'totales' => $totales
                ]);
        }
        return redirect()->to( url('dashboard/nomina') );  
    }

    public function guardarTrabajo($req){

        $resp = [
            'error' => true,
            'mensaje' => count($req->ajustes)
        ];

        DB::beginTransaction();
        try {
            
            foreach ($req->ajustes as $key => $ajuste) {
                if($ajuste > 0){
                    $insert =  [
                        'persona_id' => $req->persona_id,
                        'nomina_id' => $req->nomina_id,
                        'ajuste_persona_id' => $ajuste,
                        'total_bonos' => $req->total_bonos,
                        'total_deducciones' => $req->total_deducciones,
                        'total_pagar' => $req->total_pagar
                    ];
                    $dn = new DN($insert);
                    if(! $dn->save()){
                        throw new \Exception("ERROR AL INTENTAR GUARDAR EL DETALLE DE LA NOMINA, MODULO: nomin ARCHIVO: Nomina.php CERCA DE LA LINEA 117", 1);
                        
                    }
                }
            }
            $nomina = N::find($req->nomina_id);
            $nomina->total_nomina += $req->total_pagar;
            $nomina->total_deducciones += $req->total_deducciones;

            if(! $nomina->save() )
                throw new \Exception("ERROR AL INTENTAR ACTUALIZAR LOS DATOS DE LA NOMINA EN EL MODULO: nomina ARCHIVO: Nomina.php CERCA DE LA LINEA 127", 1);
                
            DB::commit();
            return response([
                    'error' => false,
                    'mensaje' => 'SE HA GUARDADO LA INFORMACION DE ESTA NOMINA'
                ], 200)->header('Content-Type', 'application/json');

        } catch (\Exception $e) {
            
            DB::rollback();

            return response(['error' => true, 'mensaje' => $e->getMessage()])->header('Content-Type', 'application/json');
        }
    }

    public function tipoReporte($req){
        if( $req->has('codigo_nomina') ){
            $vistaPdf = \View::make('modulos.nomina.reportes.reporte_nomina',[
                    'nomina' =>  N::where('codigo_nomina', $req->codigo_nomina)->first(),
                    'periodo' => $this->getPeriodoNomina(N::where('codigo_nomina', $req->codigo_nomina)->first()),
                    'ajustes' => A::all(),
                    'totales' => $this->totalPorAjuste(N::where('codigo_nomina', $req->codigo_nomina)->first())

                ])->render();
            $pdf = PDF::loadHtml($vistaPdf);

            return $pdf->stream('reporte_nomina_.pdf', ['attachment' => 0]);
        }
    }

    private function totalPorAjuste($nomina){
       $ajustes = A::all();
       $totalAjustes = [];

       foreach ($ajustes as $key => $ajuste) {
           $totalAjustes[$ajuste->tipo_ajuste][$ajuste->nombre_ajuste] = 0;
           $totalAjustes["TOTAL_".$ajuste->tipo_ajuste] = 0;
       }
           
        foreach ($nomina->detalles as $key => $detalle) {

            if($detalle->ajuste->ajuste->cantidad_ajuste > 0) {
                $totalAjustes[$detalle->ajuste->ajuste->tipo_ajuste][$detalle->ajuste->ajuste->nombre_ajuste] += $detalle->ajuste->ajuste->cantidad_ajuste;
                $totalAjustes['TOTAL_'.$detalle->ajuste->ajuste->tipo_ajuste] += $detalle->ajuste->ajuste->cantidad_ajuste;
            }
            else{
                $totalAjustes[$detalle->ajuste->ajuste->tipo_ajuste][$detalle->ajuste->ajuste->nombre_ajuste] += ($this->getSueldoPersona($nomina, $detalle->persona) * $detalle->ajuste->ajuste->porcentaje_ajuste) / 100;

                $totalAjustes['TOTAL_'.$detalle->ajuste->ajuste->tipo_ajuste] += ($this->getSueldoPersona($nomina, $detalle->persona) * $detalle->ajuste->ajuste->porcentaje_ajuste) / 100;
            }
                
        }
       return $totalAjustes;
    }

    private function getPeriodoNomina($nomina){
        $perido = [
            'desde' => $nomina->periodo_nomina,
            'hasta' => Carbon::now()
        ];

        /**
         * SWITCH PARA DETERMINAR EL TIPO DE NOMINA (Q: quincenal, S: semanal, M: mensual)
         *  BASADO EN ESE DATO SE ENCUENTRA EL "HASTA" DE LA NOMINA
         */
        switch ($nomina->tipo_nomina) {
            case 'Q': {
                $periodo['hasta'] = $nomina->periodo_nomina->addWeek(2);
                break;
            }
            
            case 'S':{
                $periodo['hasta'] = $nomina->periodo_nomina->addWeek(1);
                break;
            }

            case 'M':{
                $periodo['hasta'] = $nomina->periodo_nomina->endOfMotnh();
                break;
            }
        }

        $periodo['desde'] = $nomina->periodo_nomina;
        return $periodo;

    }

    public function getSueldoPersona($nomina, $persona){
        $total_persona = 0;

        switch ($nomina->tipo_nomina) {
            case 'Q': {
                return $persona->sueldo_basico / 2;
                break;
            }
            
            case 'S':{
                return $persona->sueldo_basico / 4;
                break;
            }

            case 'M':{
                return $persona->sueldo_basico;
                break;
            }
        }

    }
}
