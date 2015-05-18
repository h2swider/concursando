<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <a href="/">Volver</a>
            <h1>Registro de usuario</h1>
            <form id="register" role="form" method="POST" action="/registro/registrar-usuario/">
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon">Email</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="100" />
                    </div>
                    <div id="invalid-mail" class="alert alert-dismissable alert-danger top-buffer hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        Debes ingresar un email v&aacute;lido.
                    </div>
                    <div id="invalid-user" class="alert alert-dismissable alert-danger top-buffer hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        El usuario ya existe
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon" for="password">Contrase&ntilde;a</label>
                        <input type="password" class="form-control" id="password" name="password" maxlength="100"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon" for="password">Repetir Contrase&ntilde;a</label>
                        <input type="password" class="form-control" id="password2" name="password2" maxlength="100"/>
                    </div>
                    <div id="invalid-passwords" class="alert alert-dismissable alert-danger top-buffer hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        Las contrase&ntilde;as no coinciden
                    </div>
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
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="control-label input-group-addon">Nombre</span>
                        <input type="text" class="form-control" id="nombre" name="nombre" maxlength="45"/>
                    </div>
                    <div id="invalid-nombre" class="alert alert-dismissable alert-danger top-buffer hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        El nombre no puede estar vac&iacute;o ni contener n&uacute;meros o caracteres especiales.
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" maxlength="45" />
                    </div>
                    <div id="invalid-apellido" class="alert alert-dismissable alert-danger top-buffer hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        El apellido no puede estar vac&iacute;o ni contener n&uacute;meros o caracteres especiales.
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon" for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="text" class="form-control datepicker" id="fecha_nacimiento" name="fecha_nacimiento" />
                    </div>
                    <div id="invalid-fecha_nacimiento" class="alert alert-dismissable alert-danger top-buffer hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        Ingrese una fecha de nacimiento v&aacute;lida.
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Registrarme</button>
            </form>
        </div>
    </div>
</div>
