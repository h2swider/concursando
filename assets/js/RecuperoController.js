var particular = {
    error: [],
    init: function() {
        this.validateAtMoment();
        this.validarForm();
    },
    validateAtMoment: function() {
        $("#email").on("blur", function(evt) {
            if (global.validateEmail($(this))) {
                global.addError($(this), 'Ingrese un email válido');
            } else {
                global.addSuccess($(this));
            }
        });
    },
    validarForm: function() {
        $("main form").submit(function(evt) {
            evt.preventDefault();
            particular.error = [];
            $("#email").trigger("blur");
            if (!particular.error.length) {
                $(this).unbind("submit");
                $(this).submit();
            }
        });
    }
};