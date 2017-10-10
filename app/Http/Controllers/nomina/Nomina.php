<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\personal\Nomina as N;
use App\Models\personal\Persona as P;
use App\Models\personal\DetalleNomina as DN;
use App\Http\Controllers\utilidades\Utilidades as U;
use App\Models\personal\Ajuste as A;
use App\Models\personal\AjustePersona as AP;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator as BC;
use DB;
use PDF;
use Carbon\Carbon;
class Nomina extends Controller
{

    public function index($req){
    	return view('modulos.nomina.nominas');
    }
    
    public function cerrar($req){

        if( $req->method('post') )
        {
            $data = [
                'error' => false,
                'mensaje' => 'LA NOMINA HA SIDO CERRADA CORRECTAMENTE'
            ];
            $nomina = N::find($req->nomina);
             if( $nomina->estado_nomina == 'ABIERTA' ){
                return response([
                        'error' => true,
                        'mensaje' => 'ERROR, ESTA NOMINA YA FUE CERRADA'
                    ], 200)->header('Content-Type', 'application/json');
             }

            $nomina->estado_nomina = 'CERRADA';
            if($nomina->save()){
                return response([
                        'error' => false,
                        'mensaje' => 'LA NOMINA HA SIDO CORRECTAMENTE CERRADA'
                    ], 200)->header('Content-Type' ,'application/json');
            }else{
                return response([
                        'error' => true,
                        'mensaje' => 'ERROR AL INTENTAR CERRAR LA NOMINA, INTENTA MAS TARDE O CONTACTE A SU ADMINISTRADOR DE SISTEMAS'
                    ], 200)->header('Content-Type', 'application/json');
            }
            return response($data, 200)->header('Content-Type', 'application/json');
        }
    }

    public function trabajar($req){
    	if( $req->has('codigo_nomina') ){

    		$nomina = N::where('codigo_nomina', $req->codigo_nomina)->first();
    		if( $nomina->estado_nomina == 'ABIERTA' )
            {
                return view('modulos.nomina.trabajar_nomina', [
        				'nomina' => $nomina,
                        'codigo_nomina' => $req->codigo_nomina,
                        'persona' =>false
        			]);
            }
            return redirect()->to( url('dashboard/nomina') )->with('error', 'ERROR: ESTA NOMINA YA FUE CERRADA Y NO PUEDE VOLVER A SER TRABAJADA');
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

    public function reportes_nomina($req){
        $vista = \View::make('modulos.nomina.formularios.reportes_nomina', [
                'nomina' => $req->nomina,
            ])->render();

        return response(['error' => false, 'formulario' => $vista, 'reporte' => true], 200)->header('Content-Type', 'application/json');   
    }

    public function reportes($req){
        $persona = new P;

        if($req->has('identificacion') && $req->identificacion != '')
            $persona = $persona->where('identificacion', $req->identificacion);

        if($req->has('mina_id') && $req->mina_id!='' ){
            $persona = $persona->where('mina_id', $req->mina_id);
        }

        $nomina = N::where('codigo_nomina', $req->nomina)->first();

        $vistaPdf = \View::make('modulos.nomina.reportes.recibo_persona',[
            'personas' => $persona->get(),
            'periodo' => $this->getPeriodoNomina($nomina),
        ])->render();

        $pdf = PDF::loadHtml($vistaPdf);

        return $pdf->stream('reporte_nomina_.pdf', ['attachment' => 0]);
    }

    public function buscarPersonas($req){
        $view = \View::make('modulos.nomina.formularios.personas', [
                'personas' => P::all()
            ])->render();

       return response(['error' => false, 'formulario' => $view,])->header('Content-Type', 'application/json');
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

            if( count($persona->nominas->where('nomina_id', $nomina->id)) == 0 ){
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
        }
        return redirect()->to( url('dashboard/nomina') )->with('error', 'ESTA NOMINA YA HA SIDO TRABAJADA PARA ESTA PERSONA Y NO SE PUEDE VOLVER A TRABAJAR');  
    }

    private function calcularValor($req, $key){
    
        $aj = AP::find($req->ajustes[$key]);
        if($aj->ajuste->cantidad_ajuste > 0){

            if( $req->costos[$key] == 0 )
                return [$aj->ajuste->cantidad_ajuste , $aj->ajuste->tipo_ajuste ];
        }else{
            if( $req->costos[$key] == 0 )
                return [($aj->persona->sueldo_basico * $aj->ajuste->porcentaje_ajuste) / 100, $aj->ajuste->tipo_ajuste ];
               
        }
        
        return [$req->costos[$key] , $aj->ajuste->tipo_ajuste ];
    }

    public function guardarTrabajo($req){

        $resp = [
            'error' => true,
            'mensaje' => count($req->ajustes)
        ];

        DB::beginTransaction();
        try {
            
            if( !empty($req->ajustes) )
            {
                foreach ($req->ajustes as $key => $ajuste) {
                    if($ajuste > 0){
                        list($monto, $tipo) = $this->calcularValor($req, $key);
                        $insert =  [
                            'persona_id' => $req->persona_id,
                            'nomina_id' => $req->nomina_id,
                            'ajuste_persona_id' => $ajuste,
                            ($tipo == 'BONO') ? 'total_bonos' : 'total_deducciones' => $monto,
                            'total_pagar' => $req->total_pagar
                        ];
                        $dn = new DN($insert);
                        if(! $dn->save()){
                            throw new \Exception("ERROR AL INTENTAR GUARDAR EL DETALLE DE LA NOMINA, MODULO: nomin ARCHIVO: Nomina.php CERCA DE LA LINEA 117", 1);
                            
                        }
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
                    'totales' => $this->totalPorAjuste(N::where('codigo_nomina', $req->codigo_nomina)->first()),
                    'persona' => null

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

            $totalAjustes[$detalle->ajuste->ajuste->tipo_ajuste][$detalle->ajuste->ajuste->nombre_ajuste] += ($detalle->total_bonos > 0)? $detalle->total_bonos : $detalle->total_deducciones;

            $totalAjustes['TOTAL_'.$detalle->ajuste->ajuste->tipo_ajuste] += ($detalle->ajuste->ajuste->tipo_ajuste == 'BONO') ? $detalle->total_bonos: $detalle->total_deducciones;
                
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
                $periodo['hasta'] = $nomina->periodo_nomina->endOfMonth();
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
