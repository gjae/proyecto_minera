<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\inventario\Material as M; 

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

    public function datos_generales($req){
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
}
