<div class="container">
	<input type="hidden" id="accion" value="editar">
	{{ csrf_field() }}
	<input type="hidden" name="proveedor_id" value="{{$id}}">
	<div class="row">
		<div class="col-sm-6 col-lg-6 col-md-6">
			<h3 class="page-header">DATOS DE LA EMPRESA</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-md-6 col-lg-6">
			<label for="">RAZON SOCIAL</label>
			<input type="text" placeholder="RAZON SOCIAL DEL PROVEEDOR" value="{{ \App\Models\compras\Proveedor::find($id)->razon_social }}" maxlength="140" class="form-control" name="razon_social" id="razon_social">
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">CODIGO</label>
			<input type="text" style="text-align: center;" value="{{ \App\Models\compras\Proveedor::find($id)->codigo_proveedor }}" class="form-control" name="codigo_proveedor" readonly="" id="codigo_proveedor">
		</div>

	</div>
	<div class="row">
		
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">TELEFONO</label>
			<input type="tel" maxlength="22" value="{{ \App\Models\compras\Proveedor::find($id)->telefono }}" name="telefono" id="telefono" class="form-control" placeholder="TELEFONO DEL PROVEEDOR">
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">FAX</label>
			<input type="tel" value="{{ \App\Models\compras\Proveedor::find($id)->fax }}" maxlength="29" name="fax" id="fax" class="form-control" placeholder="FAX DEL PROVEEDOR">
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">EMAIL</label>
			<input type="email" class="form-control" value="{{ \App\Models\compras\Proveedor::find($id)->email }}" name="email" id="email" placeholder="EMAIL DEL PROVEEDOR">
		</div>
	</div>

	<div class="row">
		<div class="col-sm-9 col-md-9 col-lg-9">
			<label for="">DIRECCION</label>
			<textarea name="direccion" id="direccion" cols="30" rows="5" class="form-control">{{\App\Models\compras\Proveedor::find($id)->direccion}}</textarea>
		</div>
	</div>
	<div class="row">
		
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">TIPO DE IDENTIFICACION</label>
			<select name="tipo_identificacion" id="tipo_identificacion" class="form-control">
				<option value="">-- SELECCIONE UNO --</option>
				<option {{\App\Models\compras\Proveedor::find($id)->tipo_identificacion == 'NIT'? 'selected': '' }} value="NIT">NIT</option>
				<option {{\App\Models\compras\Proveedor::find($id)->tipo_identificacion == 'CÉDULA_DE_EXTRANJERIA'? 'selected': '' }} value="CÉDULA_DE_EXTRANJERIA">CEDULA DE EXTRANJERIA</option>
				<option {{\App\Models\compras\Proveedor::find($id)->tipo_identificacion == 'CÉDULA_DE_CIUDADANIA'? 'selected': '' }} value="CÉDULA_DE_CIUDADANIA">CEDULA DE CIUDADANIA</option>
			</select>
		</div>
		<div class="col-sm-3 col-lg-3 col-md-3">
			<label for="">IDENTIFICACION</label>
			<input type="text" value="{{ \App\Models\compras\Proveedor::find($id)->nro_identificacion}}" maxlength="60" class="form-control" name="nro_identificacion" id="nro_indentificacion">
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">CIUDAD</label>
			<select name="ciudad_id" id="ciudad_id" class="form-control">
				<option value="">-- SELECCIONE UNO --</option>
				@foreach(\App\Models\Ciudad::all() as $key => $ciudad )
					<option {{ \App\Models\compras\Proveedor::find($id)->ciudad_id == $ciudad->id? 'selected': '' }} value="{{ $ciudad->id }}">{{ $ciudad->nombre_ciudad }}</option>
				@endforeach
			</select>
		</div>

	</div>

	<div class="row">
		<div class="col-sm-6 col-md-6 col-lg-6">
			<h3 class="page-header">DATOS TRIBUTARIOS</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">RETENEDOR</label>
			<select name="retenedor" id="retenedor" class="form-control">
				<option value="">-- SELECCIONE UNO --</option>
				<option {{\App\Models\compras\Proveedor::find($id)->retenedor  == 'SI' ? 'selected' : '' }}  value="SI"> SI </option>
				<option {{\App\Models\compras\Proveedor::find($id)->retenedor == 'NO' ? 'selected' : '' }} value="NO"> NO </option>
			</select>
		</div>
		<div class="col-sm-3 col-lg-3 col-md-3">
			<label for="">REGIMEN TRIBUTARIO</label>
			<select name="regimen_tributario" id="regimen_tributario" class="form-control">
				<option value="">-- SELECCIONE UNO --</option>
				<option {{\App\Models\compras\Proveedor::find($id)->regimen_tributario == 'SIMPLIFICADO' ? 'selected' : '' }} value="SIMPLIFICADO">SIMPLIFICADO</option>
				<option {{\App\Models\compras\Proveedor::find($id)->regimen_tributario == 'COMUN' ? 'selected' : '' }} value="COMUN">COMUN</option>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-9 col-md-9 col-lg-9">
			<h3 class="page-header">DATOS FINANCIEROS</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3 col-lg-3 col-md-3">
			<label for="">TIPO DE CUENTA</label>
			<select name="tipo_cuenta" id="tipo_cuenta" class="form-control">
				<option value="">-- SELECCIONE UNO --</option>
				<option {{\App\Models\compras\Proveedor::find($id)->tipo_cuenta == 'CORRIENTE' ? 'selected' : '' }} value="CORRIENTE">CORRIENTE</option>
				<option {{\App\Models\compras\Proveedor::find($id)->tipo_cuenta == 'AHORRO' ? 'selected' : '' }} value="AHORRO">AHORRO</option>
			</select>
		</div>
		<div class="col-sm-3 col-lg-3 col-md-3">
			<label for="">NRO. CUENTA</label>
			<input type="text" value="{{ \App\Models\compras\Proveedor::find($id)->cuenta_bancaria }}" pattern="[0-9_]" maxlength="45" name="cuenta_bancaria" id="cuenta_bancaria" class="form-control">
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">ENTIDAD BANCARIA</label>
			<select name="banco_id" id="banco_id" class="form-control">
				<option value="">-- SELECCIONE UNO --</option>
				@foreach(\App\Models\administracion\Banco::all() as $banco )
					<option {{ \App\Models\compras\Proveedor::find($id)->banco_id == $banco->id? 'selected': '' }} value="{{ $banco->id }}">{{ $banco->nombre_banco }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6 col-md-6 col-lg-6">
			<h3 class="page-header">DATOS DE REPRESENTANTE</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">NOMBRE DEL REPRESENTANTE</label>
			<input type="text" placeholder="REPRESENTANTE DEL PROVEEDOR" maxlength="190" class="form-control" name="representante_legal" value="{{ \App\Models\compras\Proveedor::find($id)->representante_legal }}" id="representante_legal">
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">CEDULA</label>
			<input type="text" value="{{ \App\Models\compras\Proveedor::find($id)->cedula }}" placeholder="CEDULA" name="cedula" class="form-control" id="cedula">
		</div>
	</div>
	<div class="row">
		<div class="col sm-4 col-md-4 col-lg-4">
			<label for="">TELEFONO</label>
			<input type="tel" value="{{ \App\Models\compras\Proveedor::find($id)->telefono_representante }}" placeholder="TELEFONO DEL REPRESENTANTE" maxlength="33" name="telefono_representante" id="telefono_representante" class="form-control">
		</div>
		<div class="col sm-4 col-md-4 col-lg-4">
			<label for="">EMAIL</label>
			<input type="email" value="{{ \App\Models\compras\Proveedor::find($id)->email_representante }}" class="form-control" id="email_representante" placeholder="EMAIL DEL REPRESENTANTE" name="email_representante">
		</div>
	</div>
</div>