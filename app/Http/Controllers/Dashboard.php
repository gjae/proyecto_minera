<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class Dashboard extends Controller
{
	public function index(Request $req, $modulo = null, $programa = null,$accion = null){
		$instance = '';
		if(Auth::user()->edo_reg == 0){
			Auth::logout();
			return redirect()
					->to( url('login') )
					->with('error', 'Usuario inactivo');
		}
		if( $modulo == null ){
			return view('index');
		}else{

			if( Auth::user()->tipo_usuario == 'ADMIN' ||( Auth::user()->tipo_usuario == strtoupper($modulo) || (Auth::user()->tipo_usuario == 'TRANSPORTE' && $modulo == 'viajes') )|| ($programa == 'usuarios' && $accion == 'logout') ){
				$instance = 'App\\Http\\Controllers\\'.$modulo.'\\';
				$programa = ($programa == null) ? ucfirst($modulo) : ucfirst($programa);
				$instance .= $programa;
				$instance = new $instance;
				$accion = ($accion == null )? 'index' : $accion; 

				return call_user_func_array([$instance, $accion], [
					'req' => $req
				]);
			}
			else{
				return redirect()->to( url('dashboard') );
			}

		}

	}
}
