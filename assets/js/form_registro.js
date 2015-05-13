$(document).ready(function() {
	$("#register").submit(function() {
		$("#password").val($.md5($("#password").val()));
	})
})