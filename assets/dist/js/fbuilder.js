jQuery(function ($) {
    "use strict";
    var lotsObject = {}, perimetersObject = {};
    $.each(JSON.parse(lots), function (index, value) {
        lotsObject[value.LOT_ID] = value.LOT_LIBELLE;
    });
    $.each(JSON.parse(perimeters), function (index, value) {
        perimetersObject[value.PER_ID] = value.PER_LIBELLE;
    });

    var objectPerimiters = {
        label: 'Perimetres',
        options: perimetersObject,
        multiple: "true",
        onchange: 'reloadLots(this)'
    };

    var objectLots = {
        label: 'Lots',
        options: lotsObject,
        multiple: "true",
        style: "display:none"
    };

    var typeUserAttrs = {
        text: {
            perimeters: objectPerimiters,
            lots: objectLots
        },
        textarea: {
            perimeters: objectPerimiters,
            lots: objectLots
        },
        number: {
            perimeters: objectPerimiters,
            lots: objectLots
        },
        select: {
            perimeters: objectPerimiters,
            lots: objectLots
        },
        date: {
            perimeters: objectPerimiters,
            lots: objectLots
        },
        header: {
            perimeters: objectPerimiters,
            lots: objectLots
        },
        'checkbox-group': {
            perimeters: objectPerimiters,
            lots: objectLots
        },
        'radio-group': {
            perimeters: objectPerimiters,
            lots: objectLots
        },
        paragraph: {
            perimeters: objectPerimiters,
            lots: objectLots
        }
    };

    var typeUserEvents = {
        text: {
            onadd: function (fld) {
                $(".lots-wrap label").hide();
            }
        },
        textarea: {
            onadd: function () {
                $(".lots-wrap label").hide();
            }
        },
        number: {
            onadd: function () {
                $(".lots-wrap label").hide();
            }
        },
        select: {
            onadd: function () {
                $(".lots-wrap label").hide();
            }
        },
        date: {
            onadd: function () {
                $(".lots-wrap label").hide();
            }
        },
        header: {
            onadd: function () {
                $(".lots-wrap label").hide();
            }
        },
        'checkbox-group': {
            onadd: function () {
                $(".lots-wrap label").hide();
            }
        },
        'radio-group': {
            onadd: function () {
                $(".lots-wrap label").hide();
            }
        },
        paragraph: {
            onadd: function () {
                $(".lots-wrap label").hide();
            }
        }
    };

    var textsPerimeters = {
        trigger: "Selectionner le perimètre",
        noResult: "Pas de resultats",
        search: "Recherche"
    };

    var textsLots = {
        trigger: "Selectionner le(s) lots(s)",
        noResult: "Pas de resultats",
        search: "Recherche"
    };

    var fbOptions = {
        subtypes: {
            text: ['date']
        },
        stickyControls: {
            enable: true
        },
        i18n: {
            locale: 'fr-FR',
            location: BASE_URL + "assets/vendor/form_builder/lang/"
        },
        sortableControls: true,
        typeUserAttrs: typeUserAttrs,
        disableInjectedStyle: false,
        disableFields: ['autocomplete', 'file', 'hidden', 'button'],
        disabledFieldButtons: {
            text: ['copy'],
            textarea: ['copy'],
            number: ['copy'],
            select: ['copy'],
            date: ['copy'],
            header: ['copy'],
            'checkbox-group': ['copy'],
            'radio-group': ['copy'],
            paragraph: ['copy']

        },
        onOpenFieldEdit: function (e) {
            var fieldId = e.dataset.fieldId;
            var p = $("#perimeters-" + fieldId);
            p.picker({search: true, texts : textsPerimeters});

            p.on('sp-change', function(){
                if (p.val().length > 0) {
                    $("[for=lots-" + fieldId + "]").show();
                    $('#lots-' + fieldId).picker({search: true,  texts : textsLots});
                    loadLotsByPerimeter(p.val(), fieldId);
                } else {
                    $("[for=lots-"+fieldId+"]").hide();
                    $('#lots-' + fieldId).picker('destroy');
                    $('#lots-' + fieldId).html("");
                    $('#lots-' + fieldId).hide();
                }
            });

            if (p.val().length > 0) {
                $("[for=lots-" + fieldId + "]").show();
                $('#lots-' + fieldId).picker({search: true,  texts : textsLots});
                loadLotsByPerimeter(p.val(), fieldId);
            } else {
                $("[for=lots-"+fieldId+"]").hide();
                $('#lots-' + fieldId).html("");
                $('#lots-' + fieldId).hide();
                $('#lots-' + fieldId).picker('destroy');
            }
        },
        disabledAttrs: ["access", "step", "other"],
        controlOrder: [
            'text',
            'textarea',
            'number',
            'select',
            'date',
            'header',
            'checkbox-group',
            'radio-group',
            'paragraph'
        ],
        controlPosition: 'right',
        fieldRemoveWarn: true,
        actionButtons: [],
        typeUserDisabledAttrs: {
            'checkbox-group': [
                'toggle'
            ]
        },
        disabledActionButtons: ['data', 'save'],
        typeUserEvents: typeUserEvents
    };

    var fbInstances = [];
    var addPageTab = document.getElementById("addPageTab");

    addPageTab.onclick = function () {
        var nextTab = document.getElementById("tabs").children.length + 1;
        $('<li>' +
            '<a href="#page-' + nextTab + '" data-toggle="tab">' +
            '<span>Page ' + nextTab + '</span>' +
            '<span class="glyphicon glyphicon-pencil text-muted edit"></span>' +
            '</a>' +
            '</li>').appendTo('#tabs');
        $('<div class="tab-pane" id="page-' + nextTab + '"></div>').appendTo('.tab-content');
        fbOptions.formData = "";
        fbInstances.push($("#page-" + nextTab).formBuilder(fbOptions));
        $('#tabs a:last').tab('show');
        setTimeout(function () {
            $(".lots-wrap label").hide();
        }, 500);
        var editHandler = function() {
            var t = $(this);
            t.css("visibility", "hidden");
            $(this).prev().attr("contenteditable", "true").focusout(function() {
                $(this).removeAttr("contenteditable").off("focusout");
                t.css("visibility", "visible");
            });
        };
        $(".edit").click(editHandler);
    };

    if (JSONDATA.length == 0 || JSONDATA == 'null' || JSONDATA == null || JSONDATA == undefined) {
        fbInstances.push($("#page-1").formBuilder(fbOptions));
        setTimeout(function () {
            $(".lots-wrap label").hide();
        }, 500);
    }
    else {
        for (var i = 0; i < JSON.parse(JSONDATA).length; i++) {
            fbOptions.formData = JSON.stringify(JSON.parse(JSONDATA)[i]);
            fbInstances.push($("#page-" + parseInt(i + 1)).formBuilder(fbOptions));
            setTimeout(function () {
                $(".lots-wrap label").hide();
            }, 500);
        }
    }

    $(document.getElementById("save-all")).click(function () {
        var count = 1;
        var allData = fbInstances.map(function (fb) {
            var formData = JSON.parse(fb.formData);
            if (formData.length > 0) {
                for (var i = 0; i < formData.length; i++) {
                    var element = formData[i];
                    var scrib = "scrib-" + count + "-" + parseInt(i + 1);
                    element['scrib'] = scrib;
                }
                count++;
                return formData;
            }
        });

        allData = allData.filter(function (element) {
            return element !== undefined;
        });

        $.ajax({
            url: BASE_URL + 'connaisseur/matrices/saveMatrixJsonFile/',
            data: {
                formData: allData,
                matrice_id: $("#matrice_id").val()
            },
            method: 'post',
            success: function (data) {
            }
        });
    });
});
