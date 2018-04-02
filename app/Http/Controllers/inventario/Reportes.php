<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\inventario\Material as M; 
use App\Models\minas\MaterialMina as MM;
use App\Models\Mina;
use App\Models\compras\Proveedor;

use Carbon\Carbon;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator as BC;
use PDF;
class Reportes extends Controller
{
    
    public function movimientos($req){
    	$material = M::find($req->material_id);

    	$bc = new  BC();
    	$bc->setText($material->codigo_material);
		$bc->setType(BC::Code128);
		$bc->setFontSize(23);
		
    	$vista = \View::make('modulos.reportes.datos_material', [
    			'material' => $material,
    			'barcode' => $bc->generate()
    		])->render();
    	$pdf = PDF::loadHtml($vista);

    	return $pdf->stream('reporte_inventario', ['attachment' => 0]);
    }
    public function por_proveedor($req){
        $proveedor = Proveedor::find($req->proveedor_id);
        $ingresos = $proveedor
                    ->ingresoMaterial
                    ->where('fecha_ingreso', '>=', Carbon::parse($req->fecha_desde)->format('Y-m-d'))
                    ->where('fecha_ingreso', '<=', Carbon::parse($req->fecha_hasta)->format('Y-m-d'));

        $vista = \View::make('modulos.inventario.reportes.por_proveedor',[
            'ingresos' => $ingresos,
            'proveedor' => $proveedor,
        ])->render();
        $pdf = PDF::loadHtml($vista);
        return $pdf->stream('reporte_por_proveedor');
    }

    public function datos_generales($req){

        if(!$req->has('ref') && $req->ref != 'undefined' && false)
        {
        	$bc = new  BC();
        	$material = M::find($req->material_id);
        	$bc->setText($material->codigo_material);
    		$bc->setType(BC::Code128);
    		$bc->setFontSize(23); 	
    		$bc->setScale(3);

    		$vista = \View::make('modulos.reportes.datos_articulo', [
    				'codigo' => $bc->generate(),
    				'material' =>  $material
    			])->render();

    		$pdf = PDF::loadHtml($vista);

    		return $pdf->stream('datos_item', ['attachment' => 0]);
        }
	
	#return dd("hola");
        $material = new M;

        if($req->has('material_id'))
            $material = $material->where('id', $req->material_id);
	//return dd($material->get());

        $pdf = PDF::loadView('modulos.inventario.reportes.formato_bodega', [
                    'materiales' =>  $material->get(),
                ]);
		
	$pdf->setPaper('a2', 'landscape');
       return $pdf->stream('reporte_entre_fechas', ['attachment' => 0]);
    }

    public function actividad_en_fechas($req){
    	$material = M::find($req->material_id);
    	$vista = \View::make('modulos.reportes.actividad_material_en_fechas', [
    			'material' => $material,
    			'fecha_desde' => $req->fecha_desde,
    			'fecha_hasta' => $req->fecha_hasta
    		])->render();

        $pdf = PDF::loadHtml($vista);
        
        return $pdf->stream('reporte_entre_fechas', ['attachment' => 0]);
    }

    public function ficha($req){
        if( $req->has('material_id') && !empty($req->material_id) ){
            $material = M::find($req->material_id);

            if($material)
            {
                $bc = new  BC();
                $material = M::find($req->material_id);
                $bc->setText($material->codigo_material);
                $bc->setType(BC::Code128);
                $bc->setFontSize(23);   
                $bc->setScale(2);
                $vista = \View::make('modulos.inventario.reportes.hoja_vida', [
                    'material' => $material,
                    'codigo' => $bc->generate()
                ])->render();
                $pdf = PDF::loadHtml($vista);

                return $pdf->stream('hoja_vida_'.$material->nombre_material, ['attachment' => 0]);
            }
        }
        return redirect()->to( url('index.php/dashboard/inventario/inventario') )->with('error', 'NO SE HA PODIDO ENCONTRAR EL MATERIAL SOLICITADO');
    }
}
