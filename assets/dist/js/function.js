var textsLots = {
    trigger: "Selectionner le(s) lots(s)",
    noResult: "Pas de resultats",
    search: "Recherche"
};

function onchangeFunction(element, functionName) {
    if (functionName != "")
        window[functionName](element);
}

function createNewDocument() {
    $('#choice-document-ref-modal').modal();
}

function choiceRefValidation() {
    var radio = document.getElementsByName('choice-doc-type');
    var value = "";

    for (var i = 0; i < radio.length; i++) {
        if (radio[i].checked) {
            value = radio[i].value;
            break;
        }
    }
    if (value.toLowerCase().split('$')[0] == 'complexe' || value.toLowerCase().split('$')[0] == 'complet') {
        $('#choice-perimeter-modal').modal();
    }
    else {
        console.log('Value is not complexe');
    }
    $('#value-doc-ref-selected').val(value);
}

function choiceLotAndPerimeter(element) {
    var atLeastOneIsChecked = $('input[name="choice-per-type[]"]:checked').length > 0;
    if (atLeastOneIsChecked) {
        $('#btn-valid-per-button').prop('disabled', false);
    }
    else {
        $('#btn-valid-per-button').prop('disabled', true);
    }
}

function disableAllLots(element) {
    var isChecked = element.checked;
    if (isChecked) {
        console.log('isChecked');
        $(".other-checkbox :input[type=checkbox]").attr('disabled', 'true');
    }
    else {
        console.log('!isChecked');
        $(".other-checkbox :input[type=checkbox]").removeAttr('disabled');
    }
}

function disableOneLot(element) {
    var atLeastOneIsChecked = $(".other-checkbox :input[type=checkbox]:checked").length > 0;
    if (atLeastOneIsChecked) {
        console.log('isChecked');
        $("#perimeter-etude").attr('disabled', 'true');
    }
    else {
        console.log('!isChecked');
        $("#perimeter-etude").removeAttr('disabled');
    }
}

function generateOrSaveDocument(state) {
    if (state == TERMINEE) {
        $("#document-state").val(state);
        $('#confirm-modal').modal();
    } else {
        $("#document-state").val(state);
    }
}

function cancelDocument(id) {
    $("#document-id-cancel").val(id);
    $('#confirm-modal-cancel').modal();
}

function validCancelDocument() {
    $.ajax({
        url: BASE_URL + 'redacteur/cancelDocumentAction',
        data: {id: $("#document-id-cancel").val()},
        method: 'post',
        success: function (data) {
            window.location.replace(BASE_URL + 'redacteur');
        }
    });
}

function createModal(id) {
    if (id == "create-champs")
        fillFormChamp();
    if (id == "create-matrices")
        fillFormMatrice();
    $("#" + id).modal();
}

function fillFormChamp() {
    $("#CHAMPS_VAL").val('');
    $("#CHAMPS_TYPE_ID").val('');
    $("#CHAMPS_DEFAULT_VALUE").val('');
    $('#CHAMPS_OBLIGATOIRE').prop('checked', false);
    $("#CHAMPS_UNIQUE_NAME").val('');
    $("#CHAMPS_LIBELLE").val('');
    $("#CHAMPS_LIEN").val('');
    $("#CHAMPS_MSG_HELP").val('');
}

function fillFormMatrice() {
    if ($("#MATRICES_INIT").val() == "" || $("#MATRICES_DOC_REF").val() == "")
        $("#btn-valid-matrices").prop('disabled', true);
    else
        $("#btn-valid-matrices").prop('disabled', false);

    var typeCreation = $("#MATRICES_CREATION_TYPE").val();
    if (typeCreation == "") {
        $('#MATRICES_DIV_EMPTY').hide();
        $('#MATRICES_DIV_BY_DOC').hide();
        $('#MATRICES_DIV_DOC_REF').hide();
    } else if (typeCreation == "1") {
        $('#MATRICES_DIV_EMPTY').hide();
        $('#MATRICES_DIV_BY_DOC').show();
        $('#MATRICES_DIV_DOC_REF').show();
    } else if (typeCreation == "2") {
        $('#MATRICES_DIV_EMPTY').show();
        $('#MATRICES_DIV_BY_DOC').hide();
        $('#MATRICES_DIV_DOC_REF').show();
    }
}


function onchangeCreationType(element) {
    if (element.value == "") {
        $('#MATRICES_DIV_EMPTY').hide();
        $('#MATRICES_DIV_BY_DOC').hide();
        $('#MATRICES_DIV_DOC_REF').hide();
    } else if (element.value == "1") {
        if($("#MATRICES_INIT").val() != "" && $("#MATRICES_DOC_REF").val() != "")
            $("#btn-valid-matrices").prop('disabled', false);
        else
            $("#btn-valid-matrices").prop('disabled', true);
        $('#MATRICES_DIV_EMPTY').hide();
        $('#MATRICES_DIV_BY_DOC').show();
        $('#MATRICES_DIV_DOC_REF').show();
    } else if (element.value == "2") {

        if($("#MATRICES_DOC_REF").val() != "")
            $("#btn-valid-matrices").prop('disabled', false);
        else
            $("#btn-valid-matrices").prop('disabled', true);
        $('#MATRICES_DIV_EMPTY').show();
        $('#MATRICES_DIV_BY_DOC').hide();
        $('#MATRICES_DIV_DOC_REF').show();
    }
}

function searchElementToSetLots(dataJsonPortion, elemToSearch) {
    for (var i = 0; i < dataJsonPortion.length; i++) {
        if (dataJsonPortion[i].name == elemToSearch) {
            return dataJsonPortion[i].lots;
        } else
            continue;
    }
    return null;
}

function reloadLots(elem) {
    var fieldId = elem.offsetParent.id;
    if(elem.value != 0) {

        $('#lots-' + fieldId).picker({search: true,  texts : textsLots});
        $("[for=lots-"+fieldId+"]").show();
        loadLotsByPerimeter(elem.value, fieldId);
    }
    else {
        $("[for=lots-"+fieldId+"]").hide();
        $('#lots-' + fieldId).picker('destroy');
        $('#lots-' + fieldId).html("");
        $('#lots-' + fieldId).hide();
    }
}


function serachLotInArray(lotsToSet, lotId) {
    if(lotsToSet != undefined) {
        if (lotsToSet.length > 0) {
            for (var j = 0; j < lotsToSet.length; j++) {
                if (lotId == lotsToSet[j])
                    return true;
                else
                    continue;
            }
        }
        return false;
    }
    else
        return false;
}

function onchangeReference(element) {
    $("#SS_REFERENCE_ID").html('');
    if (element.value != "") {
        $("#SS_REFERENCE_ID").append(
            '<option  value=""> Selectionnez un sous dossier de référence </option>'
        );
        $.ajax({
            url: BASE_URL_CONNAISEUR + 'sousReferences/getSousReferenceByIdReference',
            data: {referenceID: element.value},
            method: 'post',
            success: function (data) {
                $.each(JSON.parse(data), function (i, item) {
                    $("#SS_REFERENCE_ID").append(
                        '<option  value="' + item.SS_REFERENCE_ID + '"> ' + item.SS_REFERENCE_LIBELLE + ' </option>'
                    );
                });
                $('#SS_REFERENCE_ID').addClass('selectpicker');
                $('#SS_REFERENCE_ID').attr('data-live-search', 'true');
                $('#SS_REFERENCE_ID').selectpicker('refresh');
                $("#MATRICES_SS_REFERENCE_DIV").show();
            }
        });

    }
    else {
        $("#MATRICES_SS_REFERENCE_DIV").hide();
    }
}

function loadLotsByPerimeter(perimeter_id, fieldId) {
    $('#lots-' + fieldId).html("");
    $.ajax({
        url: BASE_URL_CONNAISEUR + 'lots/getLotByPerimeterId/',
        data: {
            perimeter_id: perimeter_id
        },
        method: 'post',
        success: function (data) {
            if (data != null) {
                var elemToSearch = $("#name-" + fieldId).val();
                var position = $("#frmb-" + fieldId.split('-')[1] + "-form-wrap").parent().attr('id').split('-')[1];
                $.ajax({
                    url: BASE_URL_CONNAISEUR + 'matrices/getJSONData',
                    data: {idMatrice: $('#matrice_id').val()},
                    method: 'post',
                    success: function (dataJSON) {
                        if (dataJSON.length !== 0 && dataJSON !== 'null' && dataJSON !== null && dataJSON !== undefined) {
                            if(JSON.parse(dataJSON)[parseInt(position) - 1] != undefined) {
                                if (JSON.parse(dataJSON)[parseInt(position) - 1].length > 0) {
                                    var dataJsonPortion = JSON.parse(dataJSON)[parseInt(position) - 1];
                                    var lotsToSet = searchElementToSetLots(dataJsonPortion, elemToSearch);
                                    $.each(JSON.parse(data), function (i, lot) {
                                        if (serachLotInArray(lotsToSet, lot.LOT_ID) == true)
                                            $('#lots-' + fieldId).append('<option selected value="' + lot.LOT_ID + '">' + lot.LOT_LIBELLE + '</option>');
                                        else
                                            $('#lots-' + fieldId).append('<option value="' + lot.LOT_ID + '">' + lot.LOT_LIBELLE + '</option>');
                                    });
                                    $('#lots-' + fieldId).picker('destroy');
                                    $('#lots-' + fieldId).picker({search: true,  texts : textsLots});
                                }
                            } else {
                                $.each(JSON.parse(data), function (i, lot) {
                                    $('#lots-' + fieldId).append('<option value="' + lot.LOT_ID + '">' + lot.LOT_LIBELLE + '</option>');
                                });
                                $('#lots-' + fieldId).picker('destroy');
                                $('#lots-' + fieldId).picker({search: true,  texts : textsLots});
                            }
                        } else {
                            $.each(JSON.parse(data), function (i, lot) {
                                $('#lots-' + fieldId).append('<option value="' + lot.LOT_ID + '">' + lot.LOT_LIBELLE + '</option>');
                            });
                            $('#lots-' + fieldId).picker('destroy');
                            $('#lots-' + fieldId).picker({search: true,  texts : textsLots});
                        }
                    }
                });
            }
        }
    });
}