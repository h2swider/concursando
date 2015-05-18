<div class="container">
    <div class="row clearfix">
        <div class="col-xs-12 column">
            <h1>Recuperaci&oacute;n de Contrase&ntilde;a</h1>
            <form role="form" id="login" method="POST" action="/recuperar/submit/">
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="100" value="<?php echo isset($data['get']['e']) ? $data['get']['e'] : null ?>"/>
                    </div>
                    <div id="invalid-mail" class="alert alert-dismissable alert-danger top-buffer hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        Debes ingresar un email v&aacute;lido.
                    </div>
                </div>
                <button type="submit" class="btn btn-default pull-right">Recuperar Contrase&ntilde;a</button>
                <a href="/" alt="volver" class="btn btn-link pull-right volver">Volver</a>
            </form>
        </div>
    </div>
</div>