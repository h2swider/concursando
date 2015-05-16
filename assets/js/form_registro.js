$(document).ready(function() {
	$("#register").submit(function() {
		var error = false;
		if ($("#password").val() != '') { 
			$("#password").val($.md5($("#password").val()));
		} else {
			error = true;
		}
	})
})