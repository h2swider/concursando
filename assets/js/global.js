var global = {
    errorIcon: '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>',
    successIcon: '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>',
    init: function() {
        this.recalcularHeight();
    },
    recalcularHeight: function(){
        
        var menu_height =  $('.menu').height();
        var footer_height =  $('footer').height();
        $('main').css('min-height', window.innerHeight - menu_height - footer_height - 28);
    },
    
    validateRequire: function(campo) {
        return campo.val() === '' ? true : false;
    },
    validateString: function(campo) {
        var regexp = /^[A-Za-záéíóúñÑÁÉÍÓÚ]+$/;
        if (regexp.test(campo.val())) {
            return false;
        }
        return true;
    },
    validateEmail: function(campo) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (regex.test(campo.val())) {
            $("#invalid-mail").addClass("hidden");
            return false;
        } else {
            $("#invalid-mail").removeClass("hidden");
            return true;
        }
    },
    validatePasswords: function(p) {
        if (!global.validateRequire($(p[0])) && !global.validateRequire($(p[1]))) {
            if ($(p[0]).val() !== $(p[1]).val()) {
                $("#invalid-passwords").removeClass("hidden");
                return true;
            }
            $("#invalid-passwords").addClass("hidden");
            return false;
        }
        return true;
    },
    addError: function(selector, msg) {
        selector.parents('.form-group').find('.help-block').text(msg);
        selector.parent().removeClass("has-success");
        selector.parent().addClass('has-error');
        selector.parent().find(".glyphicon-remove").remove();
        selector.parent().find(".glyphicon-ok").remove();
        if (!selector.is("select")) {
            selector.after(global.errorIcon);
        }
        particular.error.push({campo: selector, mensaje: "Error en el campo " + selector.attr("id")});
    },
    addSuccess: function(selector, msg) {
        if(msg != null)
        selector.parents('.form-group').find('.help-block').text(msg);
        selector.parent().removeClass("has-error");
        selector.parent().addClass('has-success');
        selector.parent().find(".glyphicon-ok").remove();
        selector.parent().find(".glyphicon-remove").remove();
        if (!selector.is("select")) {
            selector.after(global.successIcon);
        }
    },
    validateFecha: function(campo) {
        if (!global.validateRequire(campo)) {
            
            var date = new Date();
            var dateParts = campo.val().split("/");
            var givenDate = new Date(dateParts[2], parseInt(dateParts[1]) - 1, dateParts[0]);

            if (givenDate > date) {
                $("#invalid-fecha_nacimiento").removeClass("hidden");
                return true;
            } else {
                $("#invalid-fecha_nacimiento").addClass("hidden");
                return false;
            }
        } else {
            return true;
        }
    }
};