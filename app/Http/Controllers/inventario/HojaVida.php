<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\inventario\Material;

use App\Models\inventario\Ficha;
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

    public function guardar_ficha($req){
        $ficha = new Ficha($req->all());
        \DB::beginTransaction();
        try {
            if( $ficha->save() ){
                \DB::commit();
                return redirect()->to( url('dashboard/inventario/inventario') )->with('correcto', 'LOS DATOS HAN SIDO ALMACENADOS DE MANERA CORRECTA');
            }
            else
                throw new \Exception("LOS DATOS NO HAN PODIDO INSERTAR LOS DATOS DE MANERA CORRECTA, VERIFIQUE Y VUELVA A INTENTAR", 1);
                
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->to( url('dashboard/inventario/inventario') )->with('error', $e->getMessage());
        }
    }
}
