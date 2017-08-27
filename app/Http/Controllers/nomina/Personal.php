<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\personal\Persona;

class Personal extends Controller
{
	public function index($req){
		$personas = Persona::all();
		return view('modulos.nomina.index', [
				'personas' => $personas
			]);
	}

	public function formulario($req){
		if( $req->has('form') ){
			$form = \View::make('modulos.nomina.formularios.'.$req->form)->render();
			$data = [
				"error" => false,
				'formulario' => $form
			];

			return response($data, 200)->header('Content-Type', 'application/json');
		}
	}
}
