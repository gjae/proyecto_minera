<div class="container">
{{ csrf_field() }}
<input type="hidden" id="accion" name="accion" value="editarPersona">
<input type="hidden" id="persona_id" name="persona_id" value="{{ $persona->id }}">
	<div class="row">
		<div class="col-sm-10 col-md-8 col-lg-8">
			<h3 class="page-header">Datos personales</h3>
		</div>
	</div>
	<div class="row">
		
		<div class="col-sm-5 col-md-5 col-lg-5">
			<label for="">Primer nombre</label>
			<input type="text" class="form-control" name="primer_nombre" id="primer_nombre" value="{{ $persona->primer_nombre }}" placeholder="Primer nombre de la persona">
		</div>
		<div class="col-sm-5 col-md-4 col-lg-4">
			<label for="">Segundo nombre</label>
			<input type="text" class="form-control" value="{{ $persona->segundo_nombre }}" name="segundo_nombre" id="segundo_nombre" placeholder="Segundo nombre de la persona">
		</div>
		
		<div class="col-sm-5 col-md-5 col-lg-5">
			<label for="">Primer apellido</label>
			<input type="text" class="form-control" name="primer_apellido" id="primer_apellido" value="{{ $persona->primer_apellido }}" placeholder="Primer apellido de la persona">
		</div>
		<div class="col-sm-5 col-md-4 col-lg-4">
			<label for="">Segundo apellido</label>
			<input type="text" class="form-control" name="segundo_apellido" id="segundo_apellido" value="{{ $persona->segundo_apellido }}" placeholder="Segundo apellido de la persona">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5 col-md-4 col-lg-4">
			<label for="">Identificacion</label>
			<input type="text" placeholder="Identificacion de la persona" id="identificacion" value="{{ $persona->identificacion }}" class="form-control" name="identificacion">
		</div>
		<div class="col-sm-5 col-md-5 col-lg-5">
			<label for="">Fecha de nacimiento (AAAA-MM-DD / DD-MM-AAAA)</label>
			<input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $persona->fecha_nacimiento->format('d-m-Y') }}" placeholder="FORMATO: AAAA-MM-DD / DD-MM-AAAA">
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3 col-md-2 col-lg-2">
			<label for="">Telefono de contacto</label>
			<input value="{{ $persona->telefono }}" type="number" id="telefono" class="form-control" name="telefono" placeholder="000000000">
		</div> 
		<div class="col-sm-2 col-md-2 col-lg-2">
			<label for="">Sexo</label>
			<select name="sexo" id="sexo" class="form-control">
				<option {{ $persona->sexo == 'HOMBRE'? 'selected' : '' }} value="HOMBRE">Hombre</option>
				<option {{ $persona->sexo == 'MUJER'? 'selected' : '' }} value="MUJER">Mujer</option>
			</select>
		</div>
		<div class="col-sm-2">
			<label for="">Ciudad natal</label>
			<select name="ciudad_id" id="ciudad_id" class="form-control">
				@foreach(App\Models\Ciudad::all() as $ciudad)
					<option {{ $persona->ciudad_id == $ciudad->id? 'selected' :'' }} value="{{ $ciudad->id }}">{{ $ciudad->nombre_ciudad }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-sm-3">
			<label for="">Tipo de sangre</label>
			<select name="tipo_sangre_id" id="tipo_sangre_id" class="form-control">
				@foreach(App\Models\personal\TipoSangre::all() as $tipo)
					<option {{ $persona->tipo_sangre_id == $tipo->id ? 'selected' :'' }} value="{{ $tipo->id }}">
						 {{ $tipo->abreviatura_tipo }}
					</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-10 col-md-9 col-lg-9">
			<label for="">Direccion</label>
			<textarea name="direccion_persona" id="direccion" cols="30" rows="10" class="form-control">{{$persona->direccion_persona}}</textarea>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-9">
			<h3 class="page-header">Datos laborales</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3">
			<label for="">Sitio de trabajo</label>
			<select name="sitio_trabajo_id" id="sitio_trabajo_id" class="form-control">
				@foreach(App\Models\personal\SitioTrabajo::all() as $sitio)
					<option {{ $persona->sitio_trabajo_id == $sitio->id ? 'selected' :'' }} value="{{ $sitio->id }}">
						{{ $sitio->nombre_sitio }}
					</option>
				@endforeach
			</select>
		</div>
		<div class="col-sm-3">
			<label for="">Cargo</label>
			<select name="cargo_id" id="cargo_id" class="form-control">
				@foreach(App\Models\personal\Cargo::all() as $cargo)
					<option {{ $persona->cargo_id == $cargo->id? 'selected' :'' }} value="{{ $cargo->id }}">
						{{ $cargo->descripcion_cargo }}
					</option>
				@endforeach
			</select>
		</div>
		<div class="col-sm-3">
			<label for="">Situacion laboral</label>
			<select name="estado_persona" id="estado_persona" class="form-control">

				@foreach(['ACTIVA', 'INACTIVA', 'JUBILADA', 'DISCAPACITADA', 'DESPEDIDA'] as $key => $estado)
				<option {{ $persona->estado_persona == $estado ? 'selected' :'' }} value="{{ $estado }}">Activa</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-4 col-lg-4">
			<label for="">EPS</label>
			<input type="text" name="eps" class="form-control" placeholder="Ingrese el EPS de la persona" value="{{ $persona->eps }}" required="Complete este campo">
		</div>
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">Pension</label>
			<input type="text" value="{{ $persona->pension }}" name="pension" class="form-control" required="Complete este campo">
		</div>
	</div>

	<div class="row">
		<div class="col-sm-5 col-md-4 col-lg-4">
			<label for="">Fecha de ingreso (AAAA-MM-DD / DD-MM-AAAA)</label>
			<input type="text" value="{{ $persona->fecha_ingreso->format('d-m-Y') }}"  class="form-control" id="fecha_ingreso" name="fecha_ingreso">		
		</div>
		<div class="col-sm-5 col-md-3 col-lg-3">
			<label for="">Sueldo base</label>
			<input type="text" value="{{ $persona->sueldo_basico }}" class="form-control" id="sueldo_basico" name="sueldo_basico" placeholder="Sueldo basico de la persona">
		</div>
		<div class="col-sm-5 col-md-2 col-lg-2">
			<label for="">Mina</label>
			<select name="mina_id" id="mina_id" class="form-control">
				<option value="1">Empleado administrativo</option>
				@foreach(App\Models\Mina::where('edo_reg', 1)->get() as $mina )
					<option {{ $persona->mina_id == $mina->id ? 'selected' : '' }} value="{{ $mina->id }}">{{ $mina->nombre_mina }}</option>
				@endforeach
			</select>
		</div>
	</div>

</div>