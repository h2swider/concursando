<div class="container">
	<div class="row clearfix">
		<div class="col-xs-12 column">
			<h1>Login</h1>
			<form role="form" id="login" method="POST" action="/login/login-usuario/">
				<div class="form-group">
					<div class="input-group">
						 <label class="control-label input-group-addon" for="email">Email</label>
						 <input type="email" class="form-control" id="email" name="email" maxlength="100" value="<?php echo isset($data['get']['e']) ? $data['get']['e'] : null ?>"/>
					</div>
				</div>
				<div id="invalid-mail" class="alert alert-dismissable alert-danger top-buffer hidden">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					Debes ingresar un correo v&aacute;lido.
				</div>
				<div class="form-group">
					<div class="input-group">
						 <label class="control-label input-group-addon" for="password">Contrase&ntilde;a</label><input type="password" class="form-control" id="password" name="password" maxlength="100" />
					</div>
				</div>
				<button type="submit" class="btn btn-default">Login</button>
			</form>
			<div id="invalid-user" class="alert alert-dismissable alert-danger top-buffer <?php echo $data['url'] !== 'invalid-user' ? 'hidden' : null ?>">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				El usuario no es v&aacute;lido.
			</div>
			<div id="inactive-user" class="alert alert-dismissable alert-danger top-buffer <?php echo $data['url'] !== 'inactive-user' ? 'hidden' : null ?>">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				Debes confirmar tu usuario antes de loguearte.
			</div>
			<div id="error-password" class="alert alert-dismissable alert-danger top-buffer <?php echo $data['url'] !== 'error-password' ? 'hidden' : null ?>">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				La contrase&ntilde;a es incorrecta.
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 column">
			<a href="#">¿No puedes acceder a tu cuenta?</a>
		</div>
		<div class="col-xs-12 column">
			<span>¿No dispones de una cuenta Concursando?</span> <a href="/registro/">Registrate Ahora</a>
		</div>
	</div>
	
</div>