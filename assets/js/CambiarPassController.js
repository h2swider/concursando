var particular = {
    error: [],
    init: function() {
        this.validateAtMoment();
        this.validarForm();
    },
    validateAtMoment: function() {
        $("input[type='password']").on("blur", function(evt) {
            if (global.validateRequire($(this))) {
                global.addError($("input[type='password']"), 'Las contraseñas no coinciden');
            } else {
                global.addSuccess($("input[type='password']"), 'ok');

            }
        });
         $("#password2").on("input", function(evt) {
            if (global.validatePasswords($("input[type='password']"))) {
                global.addError($("input[type='password']"), 'Las contraseñas no coinciden');
            } else {
                global.addSuccess($("input[type='password']"), 'ok');

            }
        });
    },
    validarForm: function() {
        $("form").submit(function(event) {
            event.preventDefault();
            particular.error = [];
            $("form input[type='password']").trigger("blur");
            $("password2").trigger("input");
            var $this = $(this);
            if (!particular.error.length) {
                $("#password").val($.md5($("#password").val()));
                $("#password2").val($.md5($("#password2").val()));
                $this.unbind("submit");
                $this.submit();
            }
        });
    }

};