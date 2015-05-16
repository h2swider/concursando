/* falta checkear el length de los strings */

var particular = {
	error: [],
	errorIcon: '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>',
	successIcon: '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>',
    init: function () {
		this.validateAtMoment();
		this.validarForm();
    },
	validateRequire: function(campo) {
		return campo.val() == '' ? true : false;
	},
	validateEmail: function(campo) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(campo.val());
	},
	validateFecha: function(campo) {
		if (!particular.validateRequire(campo)) {
			var date = new Date();
			var dateParts = campo.val().split("/");
			var givenDate = new Date(dateParts[2], parseInt(dateParts[1])-1, dateParts[0]);
			return givenDate > date ? true : false;
		} else {
			return true;
		}
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
		})
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
	validateAtMoment: function() {
		$("form input:not(.datepicker):not(input[type='email'])").each(function() {
			$(this).on("blur", function(evt) {
				if (particular.validateRequire($(this))) {
					particular.addError($(this));
				} else {
					particular.addSuccess($(this));
				}
			});
		});
		$("form input[type='email']").on("blur", function(evt) {
			var $this = $(this);
			if (!particular.validateEmail($(this))) {
				particular.addError($(this));
			} else {
				particular.validUser($(this), function(val) {
					if (val == 'true') {
						$("#invalid-user").addClass("hidden");
						particular.addSuccess($this);
					} else {
						$("#invalid-user").removeClass("hidden");
						particular.addError($this);
					}
				});
			}
		});
		$(".datepicker").on("changeDate", function(evt) {
			if (particular.validateFecha($(this))) {
				particular.addError($(this));
			} else {
				particular.addSuccess($(this));
			}
		});
		$("select").on("change", function(evt) {
			if (particular.validateRequire($(this))) {
				particular.addError($(this));
			} else {
				particular.addSuccess($(this));
			};
		})
	},
	validarForm: function() {
		
		$("form").submit(function (event) {
			event.preventDefault();
			particular.error = [];
			$("form input[type='email']").trigger("blur");
			$("form input:not(.datepicker):not(input[type='email'])").trigger("blur");
			$(".datepicker").trigger("changeDate");
			$("select").trigger("change");
			var $this = $(this);
			if (!particular.error.length) {
				$("#password").val($.md5($("#password").val()));
				particular.validUser($("#email"), function(val) {
					if (val == 'false') {
						$("#invalid-user").removeClass("hidden");
						particular.addError($("#email"));
					} else {
						$this.unbind("submit");
						$this.submit();
					}
				});
			}
        });
	}
};