<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\personal\Nomina as N;

class Nomina extends Controller
{

    public function index($req){
    	return view('modulos.nomina.nominas');
    }

    public function trabajar($req){
    	if( $req->has('codigo_nomina') ){
    		$nomina = N::where('codigo_nomina', $req->codigo_nomina)->first();
    		return view('modulos.nomina.trabajar_nomina', [
    				'nomina' => $nomina
    			]);
    	}
    	return redirect()->to( url('dashboard/nomina') );
    }
}
