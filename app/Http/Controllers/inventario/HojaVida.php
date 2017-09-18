<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\inventario\Material;

class HojaVida extends Controller
{
    public function crear($req){
    	if($req->has('id') && !empty($req->id)){
    		$material = Material::find($req->id);

    		if($material)
    		{
	    		return view('modulos.inventario.formularios.crear_hoja', [
	    				'material' => $material
	    			]);
	    	}
	    	return redirect()->to( url('dashboard/inventario/inventario') )->with('error', 'ERROR: EL ARTICULO QUE INTENTA BUSCAR NO EXISTE, INTENTE MAS TARDE');
    	}
    }
}
