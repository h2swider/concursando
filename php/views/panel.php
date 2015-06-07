<nav class="panel-izquierdo navbar col-xs-12 col-md-2 fixed-md top-buffer-xl">
    <div class="list-group">
        <a href="#" class="list-group-item">Crear Concurso</a>
        <a href="#" class="list-group-item">Mis Concursos</a>
    </div>
</nav>
<section class="crear-concurso col-xs-12 col-md-offset-2 col-md-10 bottom-buffer top-buffer-xl">
    <h2>Cre&aacute; tu concurso</h2>
    <h3>Datos iniciales</h3>
    <form enctype="multipart/form-data" id="crear" role="form" method="POST" action="/panel/crear-concurso">
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="nombre">Nombre del concurso</label>
                <input type="text" class="form-control required" id="nombre" name="nombre" maxlength="45" autofocus="true" />
            </div>
            <div class="help-block with-errors">Ingrese el nombre del concurso</div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="organizacion">Organizaci&oacute;n / empresa</label>
                <input type="text" class="form-control required" id="organizacion" name="organizacion" maxlength="100" autofocus="true" />
            </div>
            <div class="help-block with-errors">Ingrese el nombre de su organizaci&oacute;n / empresa</div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="f_inicio">Fecha de inicio</label>
                <input type="date" class="form-control required" id="f_inicio" name="f_inicio"/>
            </div>
            <div class="help-block with-errors">Ingrese la fecha de inicio del concurso</div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="f_fin">Fecha de fin</label>
                <input type="date" class="form-control required" id="f_fin" name="f_fin"/>
            </div>
            <div class="help-block with-errors">Ingrese la fecha de fin del concurso</div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="descripcion">Descripci&oacute;n</label>
                <textarea class="form-control required" id="descripcion" name="descripcion"></textarea>
            </div>
            <div class="help-block with-errors">Ingrese la descripci&oacute;n de su concurso</div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input type="file" id="archivo" name="archivo" class="required" />
            </div>
            <div class="help-block with-errors">Seleccione una imagen para su concurso</div>
        </div>
        <h3>Preguntas</h3>
        <div class="preguntas-container col-xs-12">
            <div class="row">
                <button type="button" class="btn btn-default pull-right" id="agregar_pregunta">Agregar otra pregunta</button>
            </div>
        </div>
        <div>
            <h3>Previsualizacion</h3>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Crear</button>
        <a href="/login/" alt="volver" id="volver" class="btn btn-link pull-right">Cancelar</a>
    </form>
</section>

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


<!-- Dummy Pregunta -->
<div class="col-xs-12">
    <div class="pregunta hidden dummy row">
        <div class="bottom-buffer header-box col-xs-12" >
            <button class="btn btn-danger remover-pregunta pull-right"><i class="fa fa-close"></i></button>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <div class="input-group">
                    <label class="control-label input-group-addon">Pregunta</label>
                    <input type="text" class="form-control pregunta-titulo" name="pregunta[0]"/>
                </div>
                <div class="help-block with-errors">Indique el t&iacute;tulo de su pregunta</div>
            </div>
            <div class="form-group">
               <div class="input-group">
                    <label class="input-group-addon control-label obligatorio" for="tipo">Pregunta obligatoria</label>
                    <select name="requerido[0]" class="form-control requerido">
                       <option value="S">Si</option>
                       <option value="N">No</option>
                    </select>
                </div>
                <div class="help-block with-errors">Seleccione si la pregunta va a ser obligatoria</div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <label class="input-group-addon control-label" for="tipo">Tipo de pregunta</label>
                    <select name="tipo[]" class="tipo form-control tipo">
                        <?php foreach ($data['tipos_pregunta'] as $tipo_pregunta) { ?>
                            <option value="<?php echo $tipo_pregunta['id_tipo_pregunta']; ?>"><?php echo $tipo_pregunta['descripcion']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="help-block with-errors">Seleccione un tipo de pregunta</div>
            </div>
        </div>
    </div>
</div>