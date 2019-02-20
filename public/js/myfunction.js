$(document).ready(function () {
    jQuery.validator.addMethod("greaterThan", function (value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }
        return isNaN(value) && isNaN($(params).val()) ||
                (Number(value) >= Number($(params).val()));
    }, 'Must be greater than {0}.');
    /* include this after jquery.validate* */
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
            $("#progressText").html("Étape-2");
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
            $("#progressText").html("Étape-3");
        }
    });
    $("#prev-2").click(function () {
        $("#second").hide("fast");
        $("#first").show("slow");
        $("#progressBar").css("width", "25%");
        $("#progressText").html("Étape-1");
    });
    $("#prev-3").click(function () {
        $("#second").show("fast");
        $("#third").hide("slow");
        $("#progressBar").css("width", "50%");
        $("#progressText").html("Étape-2");
    });
    $("#prev-4").click(function () {
        $("#third").show("fast");
        $("#fourth").hide("slow");
        $("#progressBar").css("width", "75%");
        $("#progressText").html("Étape-3");
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
            $("#progressText").html("Étape-4");
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
            assistantName: "required",
            fournisseur: "required",
            epuisement: "required",
            intituleAction: "required",
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
            managerName: "Veuillez renseigner ce champs.",
            assistantName: "Veuillez renseigner ce champs.",
            fournisseur: "Veuillez renseigner ce champs.",
            epuisement: "Veuillez renseigner ce champs.",
            intituleAction: "Veuillez renseigner ce champs.",
            dated: "Veuillez renseigner ce champs.",
            datef: {
                required: "Veuillez renseigner ce champs.",
                greaterThan: "La date de fin doit être supérieur à la date de début"
            },
            numeroSemaine: "Veuillez renseigner ce champs.",
            contact_plv: "Veuillez renseigner ce champs.",
            date_liv_logitoys: "Veuillez renseigner ce champs.",
            quantite_plv: "Veuillez renseigner ce champs.",
            valableFr: "Veuillez renseigner ce champs.",
            valableBe: "Veuillez renseigner ce champs.",
            valableLux: "Veuillez renseigner ce champs.",
            valableSui: "Veuillez renseigner ce champs.",
            valableIt: "Veuillez renseigner ce champs.",
            presenceCat: "Veuillez renseigner ce champs.",
            detailAction: "Veuillez renseigner ce champs.",
            numPageCat: "Veuillez renseigner ce champs.",
            interventionMax: "Veuillez renseigner ce champs.",
            remise: "Veuillez renseigner ce champs.",
            plvFournisseur: "Veuillez renseigner ce champs.",
            detailplvFournisseur: "Veuillez renseigner ce champs."
        }
    });
//recherche dans la table avec un datepicker
    if (document.getElementById("tableHome")) {
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
            dateFormat: "dd/mm/yy"
        });
        $("#max").datepicker({
            onSelect: function () {
                table.draw();
            },
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy"
        });
    }
    var table = $('#tableHome').DataTable({
        "scrollX": true,
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
    
    $('#min, #max').change(function () {
        table.draw();
    });
    
    $('#tableAdmin').DataTable({
        scrollY: 400,
        scrollCollapse: true,
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
});