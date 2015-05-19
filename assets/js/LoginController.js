var particular = {
    error: [],
    init: function() {
        this.validateAtMoment();
        this.validarForm();
    },
    validateAtMoment: function() {
        $("form input:not(.datepicker):not(input[type='email'])").on("blur", function(evt) {
            if (global.validateRequire($(this))) {
                global.addError($(this));
            } else {
                global.addSuccess($(this));
            }
        });

        $("form input[type='email']").on("blur", function(evt) {
            var $this = $(this);
            if (global.validateEmail($(this))) {
                global.addError($(this), 'Ingrese un email válido');
            } else {
                global.addSuccess($this);
            }
        });
    },
    validarForm: function() {
        $("form").submit(function(event) {
            event.preventDefault();
            particular.error = [];
            $("form input[type='email']").trigger("blur");
            $("form input:not(.datepicker):not(input[type='email'])").trigger("blur");
            var $this = $(this);
            if (!particular.error.length) {
                $("#password").val($.md5($("#password").val()));
                $this.unbind("submit");
                $this.submit();
            }
        });
    }

};