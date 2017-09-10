<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\personal\Ajuste;
use App\Models\personal\AjustePersona;
use App\Models\personal\Persona;

use DB;

class Ajustes extends Controller
{
    public function index($req){
    	$ajustes = Ajuste::all();

    	return view('modulos.nomina.ajustes_index',[
    			'ajustes' => $ajustes
    		]);
    }

    public function prepararAjuste($req){
    	$codigo = Ajuste::max('codigo_ajuste') + 1;
    	$completo_codigo = '';
    	for ($i=0; $i < ( 4 - strlen($codigo) ) ; $i++) { 
    		$completo_codigo .= '0';
    	}
    	$vista = \View::make('modulos.nomina.formularios.nuevo_ajuste', [
    			'codigo' => $completo_codigo.$codigo
    		])->render();

    	$data = [
    		'error' => false,
    		'formulario' => $vista
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');
    }

    public function guardarAjuste($req){
    	$resp = [
    		'error' => true,
    		'mensaje' => 'LOS DATOS LLEGARON'
    	];

    	DB::beginTransaction();
    	try {
    		
    		$insert = new Ajuste($req->all());
    		if(! $insert->save()){
    			throw new \Exception("ERROR AL INTENTAR ALMACENAR EL AJUSTE MODULO: nomina ARCHIVO: Ajustes.php CERCA DE LA LINEA 49", 1);
    			
    		}
    		else{

    			if(Persona::count('id') > 0)
    			{
                    if($req->ajuste_global == 'SI')
                    {
    	    			foreach (Persona::all() as $key => $persona) {
    	    				$ap = new AjustePersona(['persona_id' => $persona->id, 'ajuste_id' => $insert->id ]);
    	    				if(! $ap->save()){
    	    					throw new Exception("ERROR AL INTENTAR GUARDAR EL AJUSTE A LA PERSONA MODULO: nomina ARCHIVO: Ajustes.php CERCA DE LA LINEA 56", 1);
    	    				}
    	    			}
                    }

	    			DB::commit();
	    			return response(['error' => false, 'mensaje' => 'DATOS ALMACENADOS CORRECTAMENTE'], 200)
    					->header('Content-Type','application/json');
    			}
    			throw new \Exception("ERROR: NO EXISTEN PERSONAS A LAS CUALES ASIGNAR EL AJUSTE", 1);
    			
    		}
    	} catch (\Exception $e) {
    		DB::rollback();
    		return response(['error' => true, 'mensaje' => $e->getMessage()], 200)
    					->header('Content-Type','application/json');	
    	}
    	return response($resp, 200)->header('Content-Type', 'application/json');
    }
}
