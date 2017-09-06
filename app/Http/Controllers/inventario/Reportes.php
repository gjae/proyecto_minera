<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\inventario\Material as M; 

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator as BC;
use PDF;
class Reportes extends Controller
{
    
    public function datos_generales($req){
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
}
