<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\personal\Nomina as N;
use App\Models\personal\Persona as P;
use App\Models\personal\DetalleNomina as DN;
use App\Http\Controllers\utilidades\Utilidades as U;

use DB;
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
}
