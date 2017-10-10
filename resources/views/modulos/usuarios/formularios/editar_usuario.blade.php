@php
$user = App\User::find($id);
@endphp
<div class="container">
	<div class="row">
		{{ csrf_field() }}
		<input type="hidden" name="accion" value="editar" id="editar">
		<input type="hidden" name="user_id" value="{{ $user->id }}">
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">NOMBRE DE USUARIO</label>
			<input type="text" readonly value="{{ $user->email }}" maxlength="100" class="form-control" required name="email" id="email">
		</div>
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">TIPO DE USUARIO</label>
			<select name="tipo_usuario" required id="tipo_usuario" class="form-control">
				<option value="">-- SELECCIONE UNA --</option>
				
				<option {{ $user->tipo_usuario == 'ADMIN' ? 'selected' :'' }} value="ADMIN">
					ADMINISTRADOR
				</option>
				<option {{ $user->tipo_usuario == 'NOMINA' ? 'selected' :'' }}  value="NOMINA">NOMINA</option>
				<option {{ $user->tipo_usuario == 'REQUISICIONES' ? 'selected' :'' }}  value="REQUISICIONES">
					REQUISICIONES
				</option>
				<option  {{ $user->tipo_usuario == 'TRANSPORTE' ? 'selected' :'' }} value="TRANSPORTE">
					TRANSPORTE
				</option>
				<option  {{ $user->tipo_usuario == 'INVENTARIO' ? 'selected' :'' }}  value="INVENTARIO">
					INVENTARIO
				</option>
				<option  {{ $user->tipo_usuario == 'PROCURA' ? 'selected' :'' }}  value="PROCURA">
					COMPRAS
				</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">INGRESE UNA CLAVE (PARA CAMBIO DE CLAVE)</label>
			<input type="password" minlength="6" maxlength="12" name="password" class="form-control" id="password_1">
		</div>
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">REPITA LA CLAVE (PARA CAMBIO DE CLAVE)</label>
			<input type="password" minlength="6" maxlength="12" name="password2" class="form-control" id="password_2">
		</div>
	</div>
</div>