<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">

            <h1>Registro de usuario</h1>
            <form id="register" role="form" method="POST" action="/registro/registrar-usuario/">
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon">Email</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="100" autofocus="true" />
                    </div>
                    <div class="help-block with-errors">Ingrese su email</div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon" for="password">Contrase&ntilde;a</label>
                        <input type="password" class="form-control" id="password" name="password" maxlength="100"/>
                    </div>
                    <div class="help-block with-errors">Ingrese una contraseña</div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon" for="password">Repetir Contrase&ntilde;a</label>
                        <input type="password" class="form-control" id="password2" name="password2" maxlength="100"/>
                    </div>
                    <div class="help-block with-errors">Vuelva a ingresar su contraseña</div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="input-group-addon control-label"  for="paises">Pa&iacute;s</label>
                        <select id="paises" name="pais" class="form-control">
                            <option value=''>Seleccionar Pa&iacute;s...</option>
                            <?php foreach ($data['paises'] as $pais) { ?>
                                <option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['descripcion']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="help-block with-errors">Seleccione su país</div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="control-label input-group-addon">Nombre</span>
                        <input type="text" class="form-control" id="nombre" name="nombre" maxlength="45"/>
                    </div>
                    <div class="help-block with-errors">Ingrese su nombre</div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" maxlength="45" />
                    </div>
                    <div class="help-block with-errors">Ingrese su apellido</div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon" for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="text" class="form-control datepicker" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="dd/mm/aaaa" />
                    </div>
                    <div class="help-block with-errors">Ingrese su fecha de nacimiento</div>
                </div>
                <button type="submit" class="btn btn-default pull-right">Registrarme</button>
                <a href="/" alt="volver" id="volver" class="btn btn-link pull-right">Volver</a>
            </form>


        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-volver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Volver</h4>
            </div>
            <div class="modal-body">
                Perdera los datos ingresados ¿Desea continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary continue">Continuar</button>
            </div>
        </div>
    </div>
</div>
