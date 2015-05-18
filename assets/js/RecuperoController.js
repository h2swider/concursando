var particular = {
	error: [],
	errorIcon: '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>',
	successIcon: '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>',
	init: function() {
		this.validateAtMoment();
		this.validarForm();
	},
	addError: function(selector) {
		selector.parent().removeClass("has-success");
		selector.parent().addClass('has-error');
		selector.parent().find(".glyphicon-remove").remove();
		selector.parent().find(".glyphicon-ok").remove();
		if (!selector.is("select")) {
			selector.after(particular.errorIcon);
		}
		particular.error.push({ campo: selector, mensaje: "Error en el campo "+selector.attr("id") });
	},
	addSuccess: function(selector) {
		selector.parent().removeClass("has-error");
		selector.parent().addClass('has-success');
		selector.parent().find(".glyphicon-ok").remove();
		selector.parent().find(".glyphicon-remove").remove();
		if (!selector.is("select")) {
			selector.after(particular.successIcon);
		}
	},
	validateEmail: function(campo) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (regex.test(campo.val())) {
			$("#invalid-mail").addClass("hidden");
			particular.addSuccess(campo);
			return false;
		} else {
			particular.addError(campo);
			$("#invalid-mail").removeClass("hidden");
			return true;
		}
	},
	validateAtMoment: function() {
		$("#email").on("blur", function(evt) {
			particular.validateEmail($(this));
		})
	},
	validarForm: function() {
		$("form").submit(function(evt) {
			evt.preventDefault();
			particular.error = [];
			$("#email").trigger("blur");
			if (!particular.error.length) {
				$(this).unbind("submit");
				$(this).submit();
			}
		})
	}
}