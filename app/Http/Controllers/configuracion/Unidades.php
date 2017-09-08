<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\inventario\UnidadMedida as UM;
class Unidades extends Controller
{
    public function index($req){
    	return view('modulos.configuracion.unidades.index', [
    			'unidades' => UM::where('edo_reg', 1)->get()
    		]);
    }
}
