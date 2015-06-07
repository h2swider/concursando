var particular = {
    error: [],
    contadorPreguntas: 0,
    types: {
        ids: [4, 6],
        htmlFormat: '\
        <div class="form-group subpregunta">\
           <div class="options-container">\
                <div class="option hidden bottom-buffer">\
                    <div class="input-group">\
                        <label class="input-group-addon control-label" for="tipo">Opci&oacute;n</label>\
                        <input type="text" class="form-control" name="opcion[]" disabled="disabled"/>\
                        <span class="input-group-btn">\
                            <button class="btn btn-default opt-remove" type="button"><i class="fa fa-close"></i></button>\
                        </span>\
                    </div>\
                </div>\
           </div>\
        </div>\
        <div class="form-group">\
            <input type="button" class="btn btn-default pull-right opt-add-select" value="Agregar opci&oacute;n" />\
        </div>\
        <div class="clearfix"></div>'
    },
    init: function() {

        this.validateAtMoment();
        this.validateForm();
        this.attachEvents();
        this.firstQuestion();
    },
    eliminarOpcion: function(selector) {
        selector.remove();
    },
    agregarOpcion: function(botonAgregar) {
        var newOption = botonAgregar.parents(".pregunta").find(".option").first().clone()
        newOption.removeClass("hidden");
        newOption.find("input").removeAttr("disabled");
        newOption.appendTo(botonAgregar.parents(".pregunta").find(".options-container"));
    },
    validateAtMoment: function() {
        $(".required").on("blur", function(evt) {
            if (global.validateRequire($(this))) {
                global.addError($(this));
            } else {
                global.addSuccess($(this));
            }
        });
        $(".datepicker").on("blur", function(evt) {
            if (global.validateFecha($(this))) {
                global.addError($(this), 'Ingrese una fecha válida');
            } else {
                global.addSuccess($(this), 'ok');
            }
        });
    },
    validateForm: function() {
        $("main form").submit(function(event) {
            event.preventDefault();
            particular.error = [];
            $(".required").trigger("blur");
            $(".datepicker").trigger("blur");
            if (!particular.error.length) {
                $(this).unbind("submit");
                $(this).submit();
            }
        });
    },
    attachEvents: function() {

        $(document).on("change", ".tipo", function(evt) {
            var obj = particular.types;

            $(this).parents(".pregunta").find(".subpregunta").remove();
            $(this).parents(".pregunta").find(".clearfix").remove();
            $(this).parents(".pregunta").find(".opt-add-select").parent(".form-group").remove();

            for (var i in obj.ids) {
                if ($(this).val() == obj.ids[i]) {
                    var nroPregunta = $(this).parents(".pregunta")[0].nroPregunta;
                    var formGroup = $(this).parents(".form-group");
                    formGroup.append(obj.htmlFormat);
                    formGroup.find(".option input").attr("name", "opcion[" + nroPregunta + "][]");

                    formGroup.find('.opt-add-select').trigger('click');
                    formGroup.find('.opt-add-select').trigger('click');
                    break;
                }
            }
        });
        $(document).on("click", ".opt-remove", function(evt) {
            particular.eliminarOpcion($(this).parents(".option"));
        });
        $(document).on("click", ".opt-add-select", function(evt) {
            particular.agregarOpcion($(this));
        });
        $(document).on("click", ".remover-pregunta", function(evt) {
            $(this).parents(".pregunta").remove();
        });

        $("#agregar_pregunta").on("click", function(evt) {
            evt.preventDefault();
            var elem = $(".dummy").clone();
            var nroPregunta = ++(particular.contadorPreguntas);
            elem.find(".pregunta-titulo").attr("name", "pregunta[" + nroPregunta + "]");
            elem.find("select.requerido").attr("name", "requerido[" + nroPregunta + "]");
            elem.find("select.tipo").attr("name", "tipo[" + nroPregunta + "]");
            elem[0].nroPregunta = nroPregunta;
            elem.removeClass("hidden").removeClass("dummy");
            //$(".preguntas-container").append(elem);
            elem.insertBefore($("#agregar_pregunta").parent());
        });
    },
    firstQuestion: function() {
        if ($(".pregunta").length === 1) {
            var primeraPregunta = $(".dummy").clone();
            primeraPregunta.find("input").attr("name", "pregunta[" + particular.contadorPreguntas + "]");
            primeraPregunta.find("select.obligatorio").attr("name", "requerido[" + particular.contadorPreguntas + "]");
            primeraPregunta.find("select.tipo").attr("name", "tipo[" + particular.contadorPreguntas + "]");
            primeraPregunta[0].nroPregunta = particular.contadorPreguntas;
            primeraPregunta.removeClass("hidden").removeClass("dummy");
            primeraPregunta.insertBefore($("#agregar_pregunta").parent());
        }
        ;
    }
};