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
        $("form input:not(.datepicker):not(input[type='email'])").on("blur", function(evt) {
            if (global.validateRequire($(this))) {

                global.addError($(this));
            } else {
                global.addSuccess($(this));
            }
        });

        $("form input[type='text']").on("blur", function(evt) {
            var errorSelector = $("#invalid-" + $(this).attr("id"));
            if (global.validateString($(this))) {
                global.addError($(this));
                errorSelector.removeClass("hidden");
            } else {
                global.addSuccess($(this));
                errorSelector.addClass("hidden");
            }
            ;
        });

        $("form input[type='email']").on("blur", function(evt) {
            var $this = $(this);
            if (global.validateEmail($(this))) {
                global.addError($(this));
            } else {
                particular.validUser($(this), function(val) {
                    if (val === 'true') {
                        $("#invalid-user").addClass("hidden");
                        global.addSuccess($this);
                    } else {
                        $("#invalid-user").removeClass("hidden");
                        global.addError($this);
                    }
                });
            }
        });
        $(".datepicker").on("blur", function(evt) {
            if (global.validateFecha($(this))) {
                global.addError($(this));
            } else {
                global.addSuccess($(this));
            }
        });
        $("select").on("change", function(evt) {
            if (global.validateRequire($(this))) {
                global.addError($(this));
            } else {
                global.addSuccess($(this));
            }
            ;
        });
        $("input[type='password']").on("blur", function(evt) {
            if (global.validatePasswords($("input[type='password']"))) {
                global.addError($("input[type='password']"));
            } else {
                global.addSuccess($("input[type='password']"));

            }
        });
    },
    validarForm: function() {
        $("form").submit(function(event) {
            event.preventDefault();
            particular.error = [];
            $("form input[type='email']").trigger("blur");
            $("form input:not(.datepicker):not(input[type='email'])").trigger("blur");
            $(".datepicker").trigger("blur");
            $("select").trigger("change");
            var $this = $(this);
            if (!particular.error.length) {
                $("#password").val($.md5($("#password").val()));
                $("#password2").val($.md5($("#password2").val()));
                particular.validUser($("#email"), function(val) {
                    if (val === 'false') {
                        $("#invalid-user").removeClass("hidden");
                        global.addError($("#email"));
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