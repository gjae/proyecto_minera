<?php
namespace App\Http\Controllers\requisicion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\requisicion\Requisicion as r;
use App\Models\inventario\Material;
use App\Models\requisicion\DetalleRequisicion as DR;
use Carbon\Carbon;
use DB;
use PDF;

class Requisicion extends Controller
{
	public function index(){
		return view('modulos.requisiciones.lista_requisiciones', [
                'requisiciones' => r::all()
            ]);
	}
    public function emitir($req){
    	
    	return view('modulos.requisiciones.index', [
    		'codigo' => $this->getCodigoRequisicion()
    	]);
    }

    private function getCodigoRequisicion(){
    	$codigo = r::count('codigo_requisicion') + 1;
        $len = '';
    	for ($i=0; $i < (8 - strlen($codigo) ); $i++) { 
    		$len .= '0';
    	}
    	return $len.$codigo;
    }

    public function consultarMaterial($req){
    	$material = Material::where('codigo_material', $req->codigo)->first();

        $centros = \View::make('modulos.requisiciones.selects.centros_costos')->render();
        $etapas = \View::make('modulos.requisiciones.selects.etapas')->render();
        $disciplinas = \View::make('modulos.requisiciones.selects.disciplinas')->render();
    	$respuesta = [];
    	if($material){
    		$respuesta = [
    			'error' => false,
    			'material' => $material,
    			'unidad_medida' => $material->unidad_medida,
                'centros' => $centros,
                'etapas' => $etapas,
                'disciplinas' => $disciplinas
    		];
    	}
    	else
    		$respuesta = [
    			'error' => true,
    			'mensaje' => 'EL ARTICULO QUE HA INGRESADO NO SE ENCUENTRA REGISTRADO'
    		];

    	return response($respuesta, 200)->header('Content-Type', 'application/json');
    }

    public function guardar($req){
    	$data = [
    		'error' => true,
    		'mensaje' => 'llego la solicitud'
    	];
    	DB::beginTransaction();
    	try {

    		$requisicion = new r($req->all());
    		if($requisicion->save()){
    			if( $this->guardarDetalle($req, $requisicion) )
    			{
    				DB::commit();
    				return response([
                            'error' => false, 
                            'mensaje' => 'LA REQUISICION HA SIDO GUARDADA DE MANERA CORRECTA', 
                            'codigo' => $requisicion->codigo_requisicion
                    ])->header('Content-Type', 'application/json');
    			}
    		}
    		
    	} catch (\Exception $e) {
    		return response(['error' => true, 'mensaje' => $e->getMessage()], 200)
    				->header('Content-Type', 'application/json');
    		DB::rollback();
    	}
    	return response($data ,200)->header('Content-Type', 'application/json');
    }

    private function guardarDetalle($request, $requisicion){
    	$filas = count($request->codigos);

    	for ($i=0; $i < $filas; $i++) { 
    		$material = Material::where('codigo_material', $request->codigos[$i])->first();
    		$requisicion->detalles()->save(
    			new DR([
    				'material_id' =>$material->id,
    				'servicio_id' => 0,
    				'precio_estimado' => $request->costo_estimado[$i],
    				'porcentaje_impuesto' => $request->porcentaje_impuesto[$i],
    				'cantidad_pedida' => $request->cantidades[$i],
    				'cantidad_aprobada' => 0,
    				'total_material' =>($request->costo_estimado[$i] * $request->cantidades[$i]) + ( ( ( $request->costo_estimado[$i] * $request->cantidades[$i] ) ) * $request->porcentaje_impuesto[$i] ) / 100,
                    'diciplina_id' => $request->disciplinas_id[$i],
                    'etapa_produccion_id' => $request->etapas_id[$i],
                    'centro_costo_id' => $request->centros_id[$i]
    			])
    		);
    	}
    	return true;
    }


    public function printRequisicion($req){
        $requisiciones = r::where('codigo_requisicion', $req->codigo)->first();
       $vista = \View::make('modulos.requisiciones.reportes.formato_requisicion', [
                'requisiciones' => $requisiciones
            ])->render();
        $pdf = PDF::loadHtml($vista );
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('requisicion.pdf', ['attachment' => 0]); 
    }
}
