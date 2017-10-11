<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\inventario\Material as M; 
use App\Models\minas\MaterialMina as MM;
use App\Models\Mina;

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

        if(!$req->has('ref'))
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

        $material = new MM;

        if($req->has('material_id'))
            $material = $material->where('id', $req->material_id);

        $mina = new Mina();

        $vista = \View::make('modulos.reportes.movimientos_minas', [
                    'materiales' =>  $material->orderBy('id')->get(),
                    'minas' => $mina->get(),
                ])->render();

        $pdf = PDF::loadHtml($vista);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('movimientos_'.Carbon::now()->format('d_m_Y'), ['attachment' => 0]);
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
