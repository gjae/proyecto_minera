<div class="container">
	<input type="hidden" name="accion" value="guardar" id="accion">
	{{ csrf_field() }}

	<div class="row">
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">NOMBRE DE USUARIO</label>
			<input type="text" maxlength="100" class="form-control" required name="email" id="email">
		</div>
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">TIPO DE USUARIO</label>
			<select name="tipo_usuario" required id="tipo_usuario" class="form-control">
				<option value="">-- SELECCIONE UNA --</option>
				<option value="ADMIN">ADMINISTRADOR</option>
				<option value="NOMINA">NOMINA</option>
				<option value="REQUISICIONES">REQUISICIONES</option>
				<option value="TRANSPORTE">TRANSPORTE</option>
				<option value="INVENTARIO">INVENTARIO</option>
				<option value="PROCURA">COMPRAS</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">INGRESE UNA CLAVE</label>
			<input type="password" minlength="6" maxlength="12" required name="password" class="form-control" id="password_1">
		</div>
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">REPITA LA CLAVE</label>
			<input type="password" minlength="6" maxlength="12" required name="password2" class="form-control" id="password_2">
		</div>
	</div>
</div>