<section class="col-xs-12 col-sm-8 col-sm-offset-2">
<h2>Recuperaci&oacute;n de Contrase&ntilde;a</h2>
            <div class="alert alert-warning <?php echo !isset($data['msg'])?'hidden':null?>"><?php echo isset($data['msg'])?$data['msg']:null?></div>
            <form role="form" id="login" method="POST" action="/recuperar/submit/">
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="100" value="<?php echo isset($data['get']['e']) ? $data['get']['e'] : null ?>"/>
                    </div>
                    <div class="help-block with-errors">Ingrese su email para recuperar la clave</div>
                </div>
                <button type="submit" class="btn btn-default pull-right">Recuperar Contrase&ntilde;a</button>
                <a href="/login/" alt="volver" class="btn btn-link pull-right volver">Volver</a>
            </form>
</section>