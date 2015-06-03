var particular = {
    error: [],
    init: function() {
        this.validateAtMoment();
        this.validateForm();
        this.attachEvents();
    },
    validateAtMoment: function() {
        $("main form input:not(.datepicker):not(input[type='email']), main form textarea").on("blur", function(evt) {
            if (global.validateRequire($(this))) {
                global.addError($(this));
            } else {
                global.addSuccess($(this));
            }
        });
        $("select").on("change", function(evt) {
            if (global.validateRequire($(this))) {
                global.addError($(this), 'Seleccione un país');
            } else {
                global.addSuccess($(this), 'ok');
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
            console.log("Clicked");
            particular.error = [];
            $("main form input:not(.datepicker):not(input[type='email']), main form textarea").trigger("blur");
            $(".datepicker").trigger("blur");
            $("select").trigger("change");
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
            console.log("This has changed");
        })
    }
};