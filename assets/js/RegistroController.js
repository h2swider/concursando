var particular = {
    init: function () {

        $("#register").submit(function () {
            $("#password").val($.md5($("#password").val()));
        });
    }
};
