var particular = {
    error: [],
    init: function() {
        this.validateAtMoment();
        this.validarForm();
        this.volverAlert();
    },
    validUser: function(campo, callback) {
        $.ajax({
            type: "POST",
            url: "/registro/validar-email",
            data: {
                email: $(campo).val()
            }
        }).done(function(msg) {
            callback(msg);
        });
    },
    validateAtMoment: function() {
        $("main form input:not(.datepicker):not(input[type='email'])").on("blur", function(evt) {
            if (global.validateRequire($(this))) {
                global.addError($(this),'Complete este campo');
            } else {
                global.addSuccess($(this), 'ok');
            }
        });

        $("main form input[type='text']:not(.datepicker)").on("blur", function(evt) {
            var errorSelector = $("#invalid-" + $(this).attr("id"));
            if (global.validateString($(this))) {
                global.addError($(this), 'No es un dato válido, por favor ingrese solo letras');
                errorSelector.removeClass("hidden");
            } else {
                global.addSuccess($(this), 'ok');
                errorSelector.addClass("hidden");
            }
            ;
        });

        $("main form input[type='email']").on("blur", function(evt) {
            var $this = $(this);
            if (global.validateEmail($(this))) {
                global.addError($(this), 'Ingrese un Email válido');
            } else {
                particular.validUser($(this), function(val) {
                    if (val === 'true') {
                        $("#invalid-user").addClass("hidden");
                        global.addSuccess($this, 'ok');
                    } else {
                        $("#invalid-user").removeClass("hidden");
                        global.addError($this, 'El Email no se encuentra disponible');
                    }
                });
            }
        });
        $(".datepicker").on("blur", function(evt) {
            if (global.validateFecha($(this))) {
                global.addError($(this), 'Ingrese una fecha de nacimiento válida');
            } else {
                global.addSuccess($(this), 'ok');
            }
        });
        $("select").on("change", function(evt) {
            if (global.validateRequire($(this))) {
                global.addError($(this), 'Seleccione un país');
            } else {
                global.addSuccess($(this), 'ok');
            }
            ;
        });
        $("input[type='password']").on("blur", function(evt) {
            if (global.validatePasswords($("input[type='password']"))) {
                global.addError($("input[type='password']"), 'Las contraseñas no coinciden');
            } else {
                global.addSuccess($("input[type='password']"), 'ok');

            }
        });
    },
    validarForm: function() {
        $("main form").submit(function(event) {
            event.preventDefault();
            particular.error = [];
            $("main form input[type='email']").trigger("blur");
            $("main form input:not(.datepicker):not(input[type='email'])").trigger("blur");
           
            $(".datepicker").trigger("blur");
            
            $("select").trigger("change");
            console.log(particular.error);
            var $this = $(this);
            if (!particular.error.length) {
                $("#password").val($.md5($("#password").val()));
                $("#password2").val($.md5($("#password2").val()));
                particular.validUser($("#email"), function(val) {
                    if (val === 'false') {
                        $("#invalid-user").removeClass("hidden");
                        global.addError($("#email"), 'El Email no se encuentra disponible');
                    } else {
                        $this.unbind("submit");
                        $this.submit();
                    }
                });
            }
        });
    },
    volverAlert: function() {

        var modal_element = $('#modal-volver');
        modal_element.find('.cancel').on('click', function() {
            modal_element.modal('hide');
        });
        modal_element.find('.continue').on('click', function() {
            window.location.href = '/login';
        });
        $('#volver').on('click', function(event) {
            event.preventDefault();
            modal_element.modal();
        });

    }
};