$(document).ready(function () {
    $("#loader").remove();
    //$("#loader").delay("slow").fadeOut();
    //$("#test").delay(925).fadeIn();
    $('#test').show();
    jQuery.validator.addMethod("greaterThan", function (value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }
        return isNaN(value) && isNaN($(params).val()) ||
                (Number(value) >= Number($(params).val()));
    }, 'Must be greater than {0}.');
    $.validator.addMethod('mindate', function (v, el, minDate) {
        if (this.optional(el)) {
            return true;
        }
        var selectedDate = new Date($(el).val());
        minDate = new Date(minDate.setHours(0));
        minDate = new Date(minDate.setMinutes(0));
        minDate = new Date(minDate.setSeconds(0));
        minDate = new Date(minDate.setMilliseconds(0));
        return minDate <= selectedDate;
    }, 'Date is less than {0}.');
    /*var myTable = $('#example').DataTable({
     scrollY: '80vh',
     scrollCollapse: true,
     "scrollX": true,
     responsive: true,
     "language": {
     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
     }
     });*/
    $("#next-1").click(function (e) {
        e.preventDefault();
        if (!$('#form-data').valid()) {
            $('#form-data').valid();
            return false;
        } else {
            $("#second").show("slow");
            $("#first").hide("slow");
            $("#progressBar").css("width", "50%");
            $("#progressText").html("50%");
        }
    });
    $("#next-2").click(function (e) {
        e.preventDefault();
        if (!$('#form-data').valid()) {
            $('#form-data').valid();
            return false;
        } else {
            $("#third").show("slow");
            $("#second").hide("slow");
            $("#progressBar").css("width", "75%");
            $("#progressText").html("75%");
        }
    });
    $("#prev-2").click(function () {
        $("#second").hide("slow");
        $("#first").show("slow");
        $("#progressBar").css("width", "25%");
        $("#progressText").html("25%");
    });
    $("#prev-3").click(function () {
        $("#second").show("slow");
        $("#third").hide("slow");
        $("#progressBar").css("width", "50%");
        $("#progressText").html("50%");
    });
    $("#prev-4").click(function () {
        $("#third").show("slow");
        $("#fourth").hide("slow");
        $("#progressBar").css("width", "75%");
        $("#progressText").html("75%");
    });
    $("#next-3").click(function (e) {
        e.preventDefault();
        if (!$('#form-data').valid()) {
            $('#form-data').valid();
            return false;
        } else {
            $("#fourth").show("slow");
            $("#third").hide("slow");
            $("#progressBar").css("width", "100%");
            $("#progressText").html("100%");
        }
    });
    $("#valid-form-achat").click(function (e) {
        e.preventDefault();
        if (!$('#form-data').valid()) {
            $('#form-data').valid();
            return false;
        } else {
            document.getElementById("form-data").submit();
        }
    });
    $("#form-data").validate({
        rules: {
            managerName: "required",
            fournisseur: "required",
            epuisement: "required",
            intituleAction: "required",
            numaction: "required",
            datelivlogplvf: {
                greaterThan: "#datecomplvf"
            },
            plvmaxitoysdateliv: {
                greaterThan: "#plvmaxitoysdatecom"
            },
            dated: {
                required: true
            },
            datef: {
                required: true,
                greaterThan: "#dated"
            },
            numeroSemaine: "required",
            valableFr: "required",
            contact_plv: "required",
            date_liv_logitoys: "required",
            quantite_plv: "required",
            remise: "required"
        },
        messages: {
            datef: {
                greaterThan: "La date de fin doit être supérieur à la date de début"
            },
            datelivlogplvf: {
                greaterThan: "La date de livraison doit être supérieur à la date de commande"
            },
            plvmaxitoysdateliv: {
                greaterThan: "La date de livraison doit être supérieur à la date de commande"
            }

        }
    });
//filtre dans la table avec un datepicker
    /*if (document.getElementById("tableHome")) {
     $.fn.dataTable.ext.search.push(
     function (settings, data, dataIndex) {
     var min = $('#min').datepicker("getDate");
     var max = $('#max').datepicker("getDate");
     var d = data[2].split("/");
     var startDate = new Date(d[1] + "/" + d[0] + "/" + d[2]);
     if (min === null && max === null) {
     return true;
     }
     if (min === null && startDate <= max) {
     return true;
     }
     if (max === null && startDate >= min) {
     return true;
     }
     if (startDate <= max && startDate >= min) {
     return true;
     }
     return false;
     });
     $("#min").datepicker({
     onSelect: function () {
     table.draw();
     },
     changeMonth: true,
     changeYear: true,
     showWeek: true,
     showButtonPanel: true,
     dateFormat: "dd/mm/yy"
     });
     $("#max").datepicker({
     onSelect: function () {
     table.draw();
     },
     changeMonth: true,
     showWeek: true,
     changeYear: true,
     showButtonPanel: true,
     dateFormat: "dd/mm/yy"
     });
     }*/

    $('#tableHome tfoot .search-sort').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" id="cstomsearch" placeholder="' + title + ' rechercher" />');
    });


    $('#saveEdit').on("click", function () {
        $(this).data('clicked', true);
        table.state.save();
    });

 var table = $('#tableHome').DataTable({
        //stateDuration: -1,
        //"stateDuration": 60 * 60 * 24 * 365,
        "scrollX": true,
        autowidth: true,
        "order": [ 2, 'desc' ],
        "columnDefs": [{"targets": 0, "orderable": false, "searching": false}],
        //"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        //scrollY: '50vh',
        //scrollCollapse: true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            {
                extend: 'colvis',
                columns: ':not(.noVis)',
                text: 'Affichage des colonnes'

            }
        ],

        initComplete: function () {
            this.api().columns().every(function () {
                var that = this;
                $('#cstomsearch', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });
            $('.dt-buttons').append('<button type="button" class="dt-button buttons-collection buttons-colvis" data-toggle="modal" data-target="#exampleModal">Sauvegarder la vue</button>');
            this.api().columns.adjust().draw();
        },

        /*"stateSaveParams": function (settings, data) {
         delete data.search;
         for (var ii = 0; ii < data.columns.length; ii++)
         {
         delete data.columns[ii].search
         }
         ;
         },*/

        'stateSaveCallback': function (settings, data) {

            var token = $('#saveEdit').val();
            //console.log(JSON.stringify(data));
            if ($('#saveEdit').data('clicked')) {
                var name = $('#nomVue').val();
                var userid = $('#iduser').val();
                alert("Sauvegarde réussie");

                $.ajax({
                    'url': '/saveDatatableState',
                    'data': {"_token": token, name: name, userid: userid, 'state': JSON.stringify(data)},
                    'dataType': 'json',
                    'method': 'POST',
                    "success": function () {
                        $('#saveEdit').data('clicked', false);
                        location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError, data) {
                        console.log(thrownError, data);
                    }
                });
            }

        },
        "stateLoadCallback": function (settings, callback) {
            var token = $('#saveEdit').val();
            var defaultView= "tableHome";
            if (!$('#exampleFormControlSelect1').val() ) {
                $.ajax({
                    'url': '/loadDatatableState',
                    'data': {"_token": token, name: defaultView},
                    'dataType': 'json',
                    'type': "POST",
                    success: function (json) {
                        callback(json);
                        //console.log('test: ' + JSON.stringify(json));
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    }
                });
            } else {
                var name = $('#exampleFormControlSelect1').val();
                $.ajax({
                    'url': '/loadDatatableState',
                    'data': {"_token": token, name: name},
                    'dataType': 'json',
                    'type': "POST",
                    success: function (json) {
                        callback(json);
                        //console.log('test: ' + JSON.stringify(json));
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    }
                });
            }

        },
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        "stateDuration": 60 * 60 * 24 * 365,
        "stateSave": true
    });
    /*
     * réinitialisation de la table avec le nouveau affichage
     */
    $('#exampleFormControlSelect1').on("change", function () {
        table = $('#tableHome').DataTable({
            "destroy": true,
            "scrollX": true,
            autowidth: true,
            "order": [ 2, 'asc' ],
            "columnDefs": [{"targets": 0, "orderable": false, "searching": false}],
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                {
                    extend: 'colvis',
                    columns: ':not(.noVis)',
                    text: 'Affichage des colonnes'

                }
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var that = this;
                    $('#cstomsearch', this.footer()).on('keyup change', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
                $('.dt-buttons').append('<button type="button" class="dt-button buttons-collection buttons-colvis" data-toggle="modal" data-target="#exampleModal">Sauvegarder la vue</button>');
            },
            'stateSaveCallback': function (settings, data) {
                var token = $('#saveEdit').val();

                //console.log(JSON.stringify(data));
                if ($('#saveEdit').data('clicked')) {
                    var name = $('#nomVue').val();
                    var userid = $('#iduser').val();
                    $.ajax({
                        'url': '/saveDatatableState',
                        'data': {"_token": token, name: name, userid: userid, 'state': JSON.stringify(data)},
                        'dataType': 'json',
                        'method': 'POST',
                        "success": function () {
                            $('#saveEdit').data('clicked', false);
                            location.reload();
                        },
                        error: function (xhr, ajaxOptions, thrownError, data) {
                            console.log(thrownError, data);
                        }
                    });
                }
            },
            "stateLoadCallback": function (settings, callback) {
                var token = $('#saveEdit').val();
                var name = $('#exampleFormControlSelect1').val();
                $.ajax({
                    'url': '/loadDatatableState',
                    'data': {"_token": token, name: name},
                    'dataType': 'json',
                    'type': "POST",
                    success: function (json) {
                        callback(json);
                        //console.log('test: ' + JSON.stringify(json));
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    }
                });
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            "stateDuration": 60 * 60 * 24 * 365,
            "stateSave": true
        });
    });


    /*table.columns().every(function () {
     var that = this;
     $('input', this.footer()).on('keyup change', function () {
     if (that.search() !== this.value) {
     that.search(this.value).draw();
     }
     });
     });*/

    //$('#tableHome tfoot tr').appendTo('#tableHome thead');
    var table2 = $('#tableHome2').DataTable({
        "scrollX": true,
        scrollY: '50vh',
        "paging": false,
        scrollCollapse: true,
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
    var table3 = $('#tableHome3').DataTable({
        "scrollX": true,
        scrollY: '50vh',
        "paging": false,
        scrollCollapse: true,
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
    var table4 = $('#tableHome4').DataTable({
        "scrollX": true,
        scrollY: '50vh',
        "paging": false,
        scrollCollapse: true,
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
    /*$('#min, #max').change(function () {
     table.draw();
     });*/

    $('#tableAdmin').DataTable({
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
    $.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '',
        closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
        prevText: '<Préc', prevStatus: 'Voir le mois précédent',
        nextText: 'Suiv>', nextStatus: 'Voir le mois suivant',
        currentText: 'Courant', currentStatus: 'Voir le mois courant',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun',
            'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre année',
        weekHeader: 'Sm', weekStatus: '',
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
        dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
        dateFormat: 'dd/mm/yy', firstDay: 1,
        initStatus: 'Choisir la date', isRTL: false};
    $.datepicker.setDefaults($.datepicker.regional['fr']);
    /*$(".btn-modif-edit").on('click', function () {
     var id = $(this).attr('data-id');
     var role = $('#a' + id).children('td[data-target=role]').text();
     var groupe = $('#a' + id).children('td[data-target=groupe]').text();
     $('#type').val(role);
     $('#groupe').val(groupe);
     });*/

    $("#btn-actparam").click(function () {

        $(this).text(function (i, text) {
            return text === "Afficher les actions" ? "Cacher les actions" : "Afficher les actions";
        });
        $("#tableHome2_wrapper").toggle('slow');
    });
    $("#btn-scomm").click(function () {

        $(this).text(function (i, text) {
            return text === "Afficher les détails" ? "Cacher les détails" : "Afficher les détails";
        });
        $("#tableHome3_wrapper").toggle('slow');
    });
    $("#btn-web").click(function () {

        $(this).text(function (i, text) {
            return text === "Afficher web" ? "Cacher web" : "Afficher web";
        });
        $("#tableHome4_wrapper").toggle('slow');
    });
    /*
     * permet la modification de la table #tableHome
     */

    // to avoid twice click on td;
    $("#tableHome").on('click.input', 'input', function (event) {
        event.stopPropagation();
    });
    $("#tableHome").on('click', '.cold', function () {
        var $td = $(this);
        var text = $(this).text();
        //text = text.split('/').reverse().join('-');
        var $input = $('<input id="datep" class="datepickerd" value="' + text + '"/>');
        $td.html('').append($input);
        $input.datepicker({
            dateFormat: 'dd-mm-yy',
            onClose: function (dateText, inst) {
                $td.html(dateText.split('-').reverse().join('/'));
                $td.attr('disabled', false);
                dateText.split('-').reverse().join('/');
            }
        }).datepicker('show');
        $('.datepickerd').on('change', function () {
            var _token = $('input[name="_token"]').val();
            var column_name = $(this).parent().data("column_name");
            var column_value = $input.val().split('-').reverse().join('/');
            var id = $(this).parent().attr('data-id');
            var dated = $(this).parent().parent().find('#dated').text();
            var datef = $(this).parent().parent().find('#datef').text();
            dated = dated.split('/').reverse().join('-');
            datef = datef.split('/').reverse().join('-');
            column_value = column_value.split('/').join('-')
            if (column_value != '')
            {
                $.ajax({
                    url: "/editTab",
                    method: "POST",
                    data: {column_name: column_name, column_value: column_value, id: id, _token: _token, dated: dated, datef: datef},
                    success: function (data)
                    {
                        $('#message').html(data);
                    },
                    error: function (xhr, status, error) {
                        var err = JSON.parse(xhr.responseText);
                        alert(err.message);
                    }
                });
            } else
            {
                alert('Champs vide! Cette modification ne sera pas enregistrée.');
            }
        });
    });
    $('#tableHome').on('blur', '.column_namep', function () {


        var _token = $('input[name="_token"]').val();
        var column_name = $(this).data("column_name");
        var column_value = $(this).text();
        var id = $(this).data("id");
        if ($.trim(column_value) !== '')
        {
            $.ajax({
                url: "/editTab",
                method: "POST",
                data: {column_name: column_name, column_value: column_value, id: id, _token: _token},
                success: function (data)
                {
                    $('#message').html(data);
                }
            });
        } else
        {
            alert('Champs vide! Cette modification ne sera pas enregistrée.');
        }
    });
    $('#tableLog').DataTable();
});