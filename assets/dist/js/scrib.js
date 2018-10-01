var BROUILLON = 1, TERMINEE = 2, ENCOURS = 3;

$(document).on("click", ".display-form-edit", function () {
    var data = $(this).data('champ');
    var type_champ = JSON.parse($(this).data('typechamp')[0]);
    var id = $(this).data('id');

    $(".btn-group .btn-danger").hide();

    $("#CHAMPS_TYPE_ID_EDIT").html('');

    $.each(type_champ, function (key, data_type) {
        if (data.CHAMPS_TYPE_ID == data_type.value) {
            $('#CHAMPS_TYPE_ID_EDIT')
                .append($("<option></option>")
                    .attr("value", data_type.value)
                    .attr("selected", true)
                    .text(data_type.text));
        }
        else {
            $('#CHAMPS_TYPE_ID_EDIT')
                .append($("<option></option>")
                    .attr("value", data_type.value)
                    .text(data_type.text));
        }
    });


    $('#CHAMPS_TYPE_ID_EDIT').selectpicker('refresh');
    $("#CHAMPS_ID").val(id);
    $("#CHAMPS_VAL_EDIT").val(data.CHAMPS_VAL);
    $("#CHAMPS_DEFAULT_VALUE_EDIT").val(data.CHAMPS_DEFAULT_VALUE);
    $("#CHAMPS_OBLIGATOIRE_EDIT").val(data.CHAMPS_OBLIGATOIRE);

    if (data.CHAMPS_OBLIGATOIRE == "t")
        $('#CHAMPS_OBLIGATOIRE_EDIT').prop('checked', true);
    else
        $('#CHAMPS_OBLIGATOIRE_EDIT').prop('checked', false);

    $("#CHAMPS_UNIQUE_NAME_EDIT").val(data.CHAMPS_UNIQUE_NAME);
    $("#CHAMPS_LIBELLE_EDIT").val(data.CHAMPS_LIBELLE);
    $("#CHAMPS_LIEN_EDIT").val(data.CHAMPS_LIEN);
    $("#CHAMPS_SUFFIXE_EDIT").val(data.CHAMPS_SUFFIXE);
    $("#CHAMPS_MSG_HELP_EDIT").val(data.CHAMPS_MSG_HELP);
    $('#update-champs').modal();
});

$(function () {
    setTimeout(function () {
        $('.notification').slideUp('slow');
    }, 3000);


    if($('.menu-selection').length > 0) {
        $('.menu-selection').tooltip({
            template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner large"></div></div>'
        });
    }
    $('.selectpicker').selectpicker();

    /*** ******************************************************************************** DATATABLE ******************************************************************/
    $('#dataTables-perimeters').DataTable({
        responsive: true,
        "ordering": false,
        "language": {
            "lengthMenu": "Nombre d'élément à afficher par page _MENU_",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "search": "Recherche",
            "paginate": {
                "previous": "<i class='fa fa-angle-double-left'></i>",
                "next": "<i class='fa fa-angle-double-right'></i>"
            }
        },
        bFilter: true,
        bInfo: false,
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $('.perimeter-name').editable({
                    emptytext: 'Vide',
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'Ce champ est obligatoire';
                    }
                }
            );
            $('.perimeter-description').editable({
                emptytext: 'Vide'
            });
        }
    });

    $('#dataTables-lots').DataTable({
        responsive: true,
        "ordering": false,
        "language": {
            "lengthMenu": "Nombre d'élément à afficher par page _MENU_",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "search": "Recherche",
            "paginate": {
                "previous": "<i class='fa fa-angle-double-left'></i>",
                "next": "<i class='fa fa-angle-double-right'></i>"
            }
        },
        bFilter: true,
        bInfo: false,
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $('.lot-perimeter').editable({
                    emptytext: 'Vide',
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'Ce champ est obligatoire';
                    }
                }
            );
            $('.lot-name').editable({
                    emptytext: 'Vide',
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'Ce champ est obligatoire';
                    }
                }
            );

            $('.lot-description').editable({
                emptytext: 'Vide'
            });
        }
    });

    $('#dataTables-groupments').DataTable({
        responsive: true,
        "ordering": false,
        "language": {
            "lengthMenu": "Nombre d'élément à afficher par page _MENU_",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "search": "Recherche",
            "paginate": {
                "previous": "<i class='fa fa-angle-double-left'></i>",
                "next": "<i class='fa fa-angle-double-right'></i>"
            }
        },
        bFilter: true,
        bInfo: false,
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $('.regroupment-name').editable({
                    emptytext: 'Vide',
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'Ce champ est obligatoire';
                    }
                }
            );
        }
    });

    $('#dataTables-typeschamps').DataTable({
        responsive: true,
        "ordering": false,
        "language": {
            "lengthMenu": "Nombre d'élément à afficher par page _MENU_",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "search": "Recherche",
            "paginate": {
                "previous": "<i class='fa fa-angle-double-left'></i>",
                "next": "<i class='fa fa-angle-double-right'></i>"
            }
        },
        bFilter: true,
        bInfo: false,
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $('.typeschamp-name').editable({
                    emptytext: 'Vide',
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'Ce champ est obligatoire';
                    }
                }
            );
        }
    });

    $('#dataTables-matrices').DataTable({
        responsive: true,
        "ordering": false,
        "language": {
            "lengthMenu": "Nombre d'élément à afficher par page _MENU_",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "search": "Recherche",
            "paginate": {
                "previous": "<i class='fa fa-angle-double-left'></i>",
                "next": "<i class='fa fa-angle-double-right'></i>"
            }
        },
        bFilter: true,
        bInfo: false,
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $('.matrices-name').editable({
                    emptytext: 'Vide',
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'Ce champ est obligatoire';
                    }
                }
            );
        }
    });


    $('#dataTables-champs').DataTable({
        responsive: true,
        "ordering": false,
        "language": {
            "lengthMenu": "Nombre d'élément à afficher par page _MENU_",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "search": "Recherche",
            "paginate": {
                "previous": "<i class='fa fa-angle-double-left'></i>",
                "next": "<i class='fa fa-angle-double-right'></i>"
            }
        },
        bFilter: true,
        bInfo: false,
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $('.champs-name').editable({
                    emptytext: 'Vide',
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'Ce champ est obligatoire';
                    }
                }
            );
        }
    });

    $('#dataTables-references').DataTable({
        responsive: true,
        "ordering": false,
        "language": {
            "lengthMenu": "Nombre d'élément à afficher par page _MENU_",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "search": "Recherche",
            "paginate": {
                "previous": "<i class='fa fa-angle-double-left'></i>",
                "next": "<i class='fa fa-angle-double-right'></i>"
            }
        },
        bFilter: true,
        bInfo: false,
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $('.reference-name').editable({
                    emptytext: 'Vide',
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'Ce champ est obligatoire';
                    },
                    success: function(response, newValue) {
                        if(response == 'error') return 'Le dossier de référence existe déjà dans la base';
                    }
                }
            );
        }
    });


    $('#dataTables-ss-references').DataTable({
        responsive: true,
        "ordering": false,
        "language": {
            "lengthMenu": "Nombre d'élément à afficher par page _MENU_",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "search": "Recherche",
            "paginate": {
                "previous": "<i class='fa fa-angle-double-left'></i>",
                "next": "<i class='fa fa-angle-double-right'></i>"
            }
        },
        bFilter: true,
        bInfo: false,
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $('.ss-reference-name').editable({
                    emptytext: 'Vide',
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'Ce champ est obligatoire';
                    },
                    success: function(response, newValue) {
                        if(response == 'error') return 'Le dossier de référence existe déjà dans la base';
                    }
                }
            );
        }
    });

    $('.dataTables-projects').DataTable({
        responsive: true,
        "ordering": false,
        "language": {
            "lengthMenu": "Nombre d'élément à afficher par page _MENU_",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "search": "Recherche",
            "paginate": {
                "previous": "<i class='fa fa-angle-double-left'></i>",
                "next": "<i class='fa fa-angle-double-right'></i>"
            }
        },
        bFilter: true,
        bInfo: false
    });
    /*********************************************************************************** DATATABLE ******************************************************************/

    /*******************************************************************JS DE SCRIB**************************************************************************/
    if($('[data-toggle="tooltip"]').length > 0) {

        $('[data-toggle="tooltip"]').tooltip();
    }
    $('input:radio[name="choice-doc-type"]').change(
        function () {
            if (this.checked) {
                $('#btn-valid-ref-button').prop('disabled', false);
            }
        }
    );

    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    /*******************************************************************END JS DE SCRIB************************************************************************/

    var editHandler = function() {
        var t = $(this);
        t.css("visibility", "hidden");
        $(this).prev().attr("contenteditable", "true").focusout(function() {
            $(this).removeAttr("contenteditable").off("focusout");
            t.css("visibility", "visible");
        });
    };
    $(".edit").click(editHandler);
});


