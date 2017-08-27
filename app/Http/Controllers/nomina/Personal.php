<?php

namespace App\Http\Controllers\nomina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Personal extends Controller
{
	public function index($req){
		echo view('modulos.nomina.index')->render();
	}
}
