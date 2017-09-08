<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\personal\Cargo;

class Cargos extends Controller
{
    public function index($req){

    	return view('modulos.configuracion.cargos.index', [
    			'cargos' => Cargo::where('edo_cargo', 1)->get()
    		]);
    }
}
