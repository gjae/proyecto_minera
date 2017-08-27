<div class="container">
{{ csrf_field() }}
	
	<div class="row">
		
		<div class="col-sm-5 ">
			<label for="">Primer nombre</label>
			<input type="text" class="form-control" name="primer_nombre" id="primer_nombre" placeholder="Primer nombre de la persona">
		</div>
		<div class="col-sm-5">
			<label for="">Segundo nombre</label>
			<input type="text" class="form-control" name="segundo_nombre" id="segundo_nombre" placeholder="Segundo nombre de la persona">
		</div>
		<div class="col-sm-7 col-sm-offset-2">
			<label for="">Identificacion</label>
			<input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Identificacion de la persona">
		</div>
	
	</div>

</div>