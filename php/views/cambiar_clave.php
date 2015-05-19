<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <h2>Cambiar Clave</h2>
            <form id="register" role="form" method="POST" action="/recuperar/guardar">
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon" for="password">Contrase&ntilde;a</label>
                        <input type="password" class="form-control" id="password" name="password" maxlength="100"/>
                    </div>
                    <div class="help-block with-errors">Ingrese su nueva clave</div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon" for="password">Repetir Contrase&ntilde;a</label>
                        <input type="password" class="form-control" id="password2" name="password2" maxlength="100"/>
                    </div>
                    <div class="help-block with-errors">Vuelva a ingresar su nueva clave</div>
                </div>
                <input type="hidden" name="token" value="<?php echo $data['url']?>">
                <button type="submit" class="btn btn-default pull-right">Cambiar Clave</button>
                <a href="/login" alt="volver" id="volver" class="btn btn-link pull-right">Cancelar</a>
            </form>
        </div>
    </div>
</div>