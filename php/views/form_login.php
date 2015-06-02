<section class="login col-xs-12 col-sm-8 col-sm-offset-2">
    <h2>Login</h2>
    <div class="alert alert-info <?php echo!isset($data['msg']) ? 'hidden' : null ?>"><?php echo isset($data['msg']) ? $data['msg'] : null ?></div>
    <div class="alert alert-success <?php echo!isset($data['confirmed']) ? 'hidden' : null ?>"><?php echo isset($data['confirmed']) ? $data['confirmed'] : null ?></div>
    <div class="alert alert-danger <?php echo!isset($data['error']) ? 'hidden' : null ?>"><?php echo isset($data['error']) ? $data['error'] : null ?></div>

    <div id="invalid-user" class="alert alert-dismissable alert-danger top-buffer <?php echo $data['url'] !== 'invalid-user' ? 'hidden' : null ?>">El usuario no es v&aacute;lido.</div>
    <div id="inactive-user" class="alert alert-dismissable alert-danger top-buffer <?php echo $data['url'] !== 'inactive-user' ? 'hidden' : null ?>">Debes confirmar tu usuario antes de loguearte.</div>
    <div id="error-password" class="alert alert-dismissable alert-danger top-buffer <?php echo $data['url'] !== 'error-password' ? 'hidden' : null ?>">La contrase&ntilde;a es incorrecta.</div>

    <form role="form" id="login" method="POST" action="/login/login-usuario/">
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="100" value="<?php echo isset($data['get']['e']) ? $data['get']['e'] : null ?>"/>
            </div>
            <div class="help-block with-errors"> </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="password">Contrase&ntilde;a</label><input type="password" class="form-control" id="password" name="password" maxlength="100" />
            </div>
        </div>
        <button type="submit" class="btn btn-default">Login</button>
    </form>
    <div class="row">
        <div class="col-xs-12 column">
            <a href="/recuperar-clave/">¿No puedes acceder a tu cuenta?</a>
        </div>
        <div class="col-xs-12 column">
            <span>¿No dispones de una cuenta Concursando?</span> <a href="/registro/">Registrate Ahora</a>
        </div>
    </div>
</section>