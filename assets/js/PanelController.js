var particular = {
    error: [],
    types: {
        ids: [4, 6],
        htmlFormat: '\
        <div class="form-group subpregunta">\
           <div class="options-container">\
                <div class="option">\
                    <label for="opcion_1">Opci&oacute;n 1: </label><input type="text" class="form-control" name="opcion_1"/>\
                    <input type="button" class="btn btn-default" class="remover-opcion" value="X" />\
                </div>\
           </div>\
           <input type="button" class="btn btn-default pull-right opt-add-select" value="Agregar otra opci&oacute;n" />\
        </div>',
        htmlEvents: [{
           event: "click",
           selector: ".opt-add-select",
           fire: function(evt) {
               
               var _this = $(evt.target);
               console.log(_this);
               _this.prev().find(".option").first().clone().appendTo(".options-container");
           }
        }, {
            event: "click",
            selector: ".remover-opcion",
            fire: function(evt) {
                
            }
        }]
    }, 
    init: function() {
        this.validateAtMoment();
        this.validateForm();
        this.attachEvents();
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
        $("#agregar_pregunta").on("click", function(evt) {
            evt.preventDefault();
            $(".pregunta").first().clone().appendTo(".preguntas-container");
        });
        
        $(document).on("change", ".tipo", function(evt) {
            for (var i in particular.types.ids) {
                if ($(this).val() == particular.types.ids[i]) {
                    $(this).parent().parent().append(particular.types.htmlFormat);
                    for (var j in particular.types.htmlEvents) {
                        $(particular.types.htmlEvents[j].selector).unbind(particular.types.htmlEvents[j].event);
                        $(particular.types.htmlEvents[j].selector).on(particular.types.htmlEvents[j].event, function(evt) {
                            particular.types.htmlEvents[j].fire(evt);
                        });
                    }                   
                    break;
                }
            }
        });
    },
    
    
};