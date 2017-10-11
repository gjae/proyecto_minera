<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class Dashboard extends Controller
{
	public function index(Request $req, $modulo = null, $programa = null,$accion = null){
		$instance = '';
		if( $modulo == null ){
			return view('index');
		}else{

			if( Auth::user()->tipo_usuario == 'ADMIN' || Auth::user()->tipo_usuario == strtoupper($modulo) ){
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
				return redirect()->to( url('index.php/dashboard') );
			}

		}

	}
}
