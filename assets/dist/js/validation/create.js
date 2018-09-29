/***** Validation pour la création des documents ***/
$("#create-document-form").validate({
    messages: {
        "document-name": {required: "Veuillez entrer le nom du document"}
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    highlight: function (element) {
        $(element).addClass("errorInput");
    },
    unhighlight: function (element) {
        $(element).removeClass("errorInput");
    },
    ignore: []
});
$("#btn-document-valid").click(function (e) {
    var settings = $("#create-document-form").validate().settings;
    $.extend(true, settings, {
        rules: {
            "document-name": {required: true}
        }
    });

    $('input.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire"
            }
        });
    });
    $('select.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire"
            }
        });
    });
    $(e).removeClass("errorInput");
});
$("#btn-document-save").click(function (e) {
    var settings = $("#create-document-form").validate().settings;
    $.extend(true, settings, {
        rules: {
            "document-name": {required: false}
        }
    });

    $('input.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire"
            }
        });
    });
    $('select.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire"
            }
        });
    });
    $(e).removeClass("errorInput");
});
/***** END Validation pour la création des documents ***/

/***** Validation pour la création ***/
$(".create-form").validate({
    messages: {
        'file[2]':{ extension: "Veuillez selectionner un fichier avec une de ces extensions : xls, xlsx"},
        'file[1]':{ extension: "Veuillez selectionner un fichier avec une de ces extensions : doc, docx"}
    },
    rules: {
        'file[2]': {extension: "xlsx|xls|XLSX|XLS"},
        'file[1]': {extension: "docx|doc|DOCX|DOC"}
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    highlight: function (element) {
        $(element).addClass("errorInput");
    },
    unhighlight: function (element) {
        $(element).removeClass("errorInput");
    }
});

$("#MATRICES_VERSION").keypress(function (e) {
    $('input.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire",
                number: "Veuillez saisir un nombre entier positif"
            }
        });
    });
});

$(".btn-valid-form").click(function (e) {
    $('input[name="file[2]"]').each(function () {
        $(this).rules("add", {
            messages: {
                extension: "Veuillez selectionner un fichier avec une de ces extensions :xls, xlsx"
            }
        });
    });
    $('input[name="file[1]"]').each(function () {
        $(this).rules("add", {
            messages: {
                extension: "Veuillez selectionner un fichier avec une de ces extensions :doc, docx"
            }
        });
    });
    $('input.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire",
                number: "Veuillez saisir un nombre entier positif"
            }
        });
    });
    $('textarea.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire"
            }
        });
    });
    $('select.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire"
            }
        });
    });
    $(e).removeClass("errorInput");
});
/***** End Validation pour la création ***/

/***** Validation pour la création des typedeschamps ***/
$("#edit-champs-form").validate({
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    highlight: function (element) {
        $(element).addClass("errorInput");
    },
    unhighlight: function (element) {
        $(element).removeClass("errorInput");
    },
    ignore: []
});

$("#btn-valid-champs-edit").click(function (e) {
    $('input.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire"
            }
        });
    });
    $('textarea.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire"
            }
        });
    });
    $('select.required').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Ce champ est obligatoire"
            }
        });
    });
    $(e).removeClass("errorInput");
});
/***** End Validation pour la création des typedeschamps ***/