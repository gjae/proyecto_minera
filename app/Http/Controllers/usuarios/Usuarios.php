<?php

namespace App\Http\Controllers\usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

class Usuarios extends Controller
{
   public function index($req){
   		$users = User::where('edo_reg', 1)->get();
   		return view('modulos.usuarios.index', [
   				'usuarios' => $users
   			]);
   }


   public function formulario($req){
       //  exit;
   		try {
   			//return dd($req->all());
   			$vista = \View::make('modulos.usuarios.formularios.'.$req->form, [
   					'id' => $req->id
   				])->render();
   			return response([
   					'error' => false,
   					'formulario' => $vista,
   					'action' => url('dashboard/usuarios/usuarios/crud'),
   				], 200)->header('Content-Type', 'application/json');

   		} catch (\Exception $e) {
   			
   		}
   }


   public function crud($req){
      //return dd($req->all());
   	return call_user_func_array([$this, $req->accion], [$req]);
   }

   private function guardar($req){
   		$usuario = User::where('email', $req->email)->first();

   		if( $usuario ){
   			return redirect()
   					->to( url('index.php/dashboard/usuarios') )
   					->with('error', 'EL NOMBRE DE USUARIO QUE INTENTA INGRESAR YA EXISTE!');
   		}

   		$usuario = new User($req->all());
   		if( $usuario->save() ){
   			return redirect()
   					->to( url('index.php/dashboard/usuarios') )
   					->with('correcto', 'USUARIO CREADO EXITOSAMENTE');
   		}
   		else{
   			
   		}
   }

   private function editar($req){
     // return dd($req->all());
       $complemento = (Auth::user()->tipo_usuario == 'USUARIO' ) ? '/usuarios/actualizar' :'';
   	if( (Auth::check() && Auth::user()->tipo_usuario == 'ADMIN' ) || $req->user_id == Auth::user()->id ){
	   		$user = User::find($req->user_id);

	   		$datos = [];
            if(Auth::user()->tipo_usuario == 'ADMIN')
	   		   $user->tipo_usuario = $req->tipo_usuario;

	   		//$datos = $req->except(['_token', 'accion', 'password', 'password2', 'user_id']);
	   		if( !is_null($req->password) )
	   		{
	   			$user->password =  $req->password;
	   		}

	   		//ASI DE FACIL ES ACTUALIZAR
	   		if( $user->save()){
              
	   			return redirect()
   					->to( url('index.php/dashboard/usuarios'.$complemento) )
   					->with('correcto', 'LOS DATOS DEL REGISTRO HAN SIDO ACTUALIZADOS CORRECTAMENTE');
	   		}
	   		return redirect()
   					->to( url('index.php/dashboard/usuarios'.$complemento) )
   					->with('error', 'ERROR AL INTENTAR ACTUALIZAR LOS DATOS DEL USUARIO');
	   	}
	   	return redirect()
   				->to( url('index.php/dashboard/usuarios'.$complemento) )
   				->with('error', 'ERROR: VERIFIQUE QUE POSEE UNA SESSION ABIERTA Y QUE TENGA EL PERMISO CORRECTO PARA ESTA ACCION');
   }


   public function eliminar($req){
   		if(Auth::check() && Auth::user()->tipo_usuario == 'ADMINc' ){
   			$user = User::find($req->id);
   			$user->edo_reg = 0;
   			if( $user->save() ){
   				return response([
   						'error' => false,
   						'mensaje' => 'REGISTRO ELIMINADO CORRECTAMENTE'
   					])->header('Content-Type', 'application/json');
   			}
   			return response([
   					'error' => true,
   					'mensaje' => 'ERROR AL INTENTAR ELIMINAR EL REGISTRO, CONSULTE SU ADMINISTRADOR DE SISTEMA'
   				], 200)->header('Content-Type', 'application/json');
   		}

   		return response([
   				'error' => true,
   				'mensaje' =>'ERROR: VERIFIQUE QUE POSEE UNA SESSION ABIERTA Y QUE TENGA EL PERMISO CORRECTO PARA ESTA ACCION'
   			], 200)->header('Content-Type', 'application/json');
   }

   public function actualizar($req){
      return view('modulos.usuarios.actualizar', [
            'user' => Auth::user()
         ]);
   }

   public function logout($req){
      Auth::logout();
      return redirect()
            ->to( url('login') )
            ->with( 'correcto', 'USTED SE HA DESCONECTADO CORRECTAMENTE' );
   }
}
