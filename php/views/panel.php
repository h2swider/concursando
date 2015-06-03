<nav class="panel-izquierdo navbar col-xs-12 col-md-2 fixed-md top-buffer-xl">
    <div class="list-group">
        <a href="#" class="list-group-item">Crear Concurso</a>
        <a href="#" class="list-group-item">Mis Concursos</a>
    </div>
</nav>
<section class="crear-concurso col-xs-12 col-md-offset-2 col-md-10 bottom-buffer top-buffer-xl">
    <h2>Cre&aacute; tu concurso</h2>
    <h3>Datos iniciales</h3>
    <form id="crear" role="form" method="POST" action="/panel">
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="nombre">Nombre del concurso</label>
                <input type="text" class="form-control" id="nombre" name="nombre" maxlength="45" autofocus="true" />
            </div>
            <div class="help-block with-errors">Ingrese el nombre del concurso</div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="organizacion">Organizaci&oacute;n / empresa</label>
                <input type="text" class="form-control" id="organizacion" name="organizacion" maxlength="100" autofocus="true" />
            </div>
            <div class="help-block with-errors">Ingrese el nombre de su organizaci&oacute;n / empresa</div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="f_inicio">Fecha de inicio</label>
                <input type="date" class="form-control" id="f_inicio" name="f_inicio"/>
            </div>
            <div class="help-block with-errors">Ingrese la fecha de inicio del concurso</div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="f_fin">Fecha de fin</label>
                <input type="date" class="form-control" id="f_fin" name="f_fin"/>
            </div>
            <div class="help-block with-errors">Ingrese la fecha de fin del concurso</div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <label class="control-label input-group-addon" for="descripcion">Descripci&oacute;n</label>
                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
            </div>
            <div class="help-block with-errors">Ingrese la descripci&oacute;n de su concurso</div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input type="file" id="archivo" name="archivo" />
            </div>
            <div class="help-block with-errors">Seleccione una imagen para su concurso</div>
        </div>
        <h3>Preguntas</h3>
        <div class="preguntas-container">
            <div class="pregunta">
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label input-group-addon">Pregunta</label>
                        <input type="text" class="form-control" name="pregunta[]"/>
                    </div>
                    <div class="help-block with-errors">Indique el t&iacute;tulo de su pregunta</div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="input-group-addon control-label" for="tipo">Tipo de pregunta</label>
                        <select name="tipo[]" class="tipo form-control">
                            <option value="">Seleccionar Tipo de pregunta...</option>
                            <?php foreach($data['tipos_pregunta'] as $tipo_pregunta) { ?>
                                <option value="<?php echo $tipo_pregunta['id_tipo_pregunta']; ?>"><?php echo $tipo_pregunta['descripcion']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="help-block with-errors">Seleccione un tipo de pregunta</div>
                </div>
             </div>
         </div>
        <button type="button" class="btn btn-default pull-right" id="agregar_pregunta">Agregar otra pregunta</button>
    <div>
        <h3>Previsualizacion</h3>
    </div>

    <button type="submit" class="btn btn-default pull-right">Crear</button>
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
