$("#login-form").validate({
    messages: {
        "login-nni": { required: "Veuillez remplir le nni" },
        "login-password": { required: "Veuillez remplir le mot de passe" }
    },
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function(element) {
        $(element).parent().addClass("error");
    },
    unhighlight: function(element) {
        $(element).parent().removeClass("error");
    }
});
$("#login-button").click(function (e) {
    var settings = $("#login-form").validate().settings;
    $.extend(true, settings, {
        rules: {
            "login-nni": {required: true},
            "login-password": {required: true}
        }
    });
    $(e).parent().removeClass("error");
});

