<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<h1>Registro de usuario</h1>
			<form id="register" role="form" method="POST" action="/registro/registrar-usuario/">
				<div class="form-group">
					<div class="input-group">
						<label class="control-label input-group-addon">Email</label>
						<input type="email" class="form-control" id="email" name="email" />
					</div>
					<div id="invalid-user" class="alert alert-dismissable alert-danger top-buffer hidden">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						El usuario ya existe
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<label class="control-label input-group-addon" for="password">Contrase&ntilde;a</label>
						<input type="password" class="form-control" id="password" name="password" />
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<label class="control-label input-group-addon" for="password">Repetir Contrase&ntilde;a</label>
						<input type="password" class="form-control" id="password2" name="password2" />
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<label class="input-group-addon control-label"  for="paises">Pa&iacute;s</label>
						<select id="paises" name="pais" class="form-control">
							<option value=''>Seleccionar Pa&iacute;s...</option>
						<?php foreach($data['paises'] as $pais) { ?>
							<option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['descripcion']; ?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="control-label input-group-addon">Nombre</span>
						<input type="text" class="form-control" id="nombre" name="nombre" />
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<label class="control-label input-group-addon">Apellido</label>
						<input type="text" class="form-control" id="apellido" name="apellido" />
					 </div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<label class="control-label input-group-addon" for="fecha_nacimiento">Fecha de Nacimiento</label>
						<input type="text" class="form-control datepicker" id="fecha_nacimiento" name="fecha_nacimiento" />
					 </div>
				</div>
				<button type="submit" class="btn btn-default">Registrarme</button>
			</form>
		</div>
	</div>
</div>
