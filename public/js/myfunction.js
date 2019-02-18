$(document).ready(function () {

    $.fn.dataTable.ext.classes.sPageButton = 'paginate_button page-item';
    $('#example').DataTable({
        "scrollX": true,
        responsive: true
    });
    $('#tableAdmin').DataTable();
    
    $("#next-1").click(function(){
        $("#second").show();
        $("#first").hide();
        $("#progressBar").css("width","50%");
        $("#progressText").html("50%");
    });
    
    $("#next-2").click(function(){
        $("#third").show();
        $("#second").hide();
        $("#progressBar").css("width","75%");
        $("#progressText").html("75%");
    });
    
    $("#prev-2").click(function(){
        $("#second").hide();
        $("#first").show();
        $("#progressBar").css("width","25%");
        $("#progressText").html("25%");
    });
    
    $("#prev-3").click(function(){
        $("#second").show();
        $("#third").hide();
        $("#progressBar").css("width","50%");
        $("#progressText").html("50%");
    });
    
    $("#prev-4").click(function(){
        $("#third").show();
        $("#fourth").hide();
        $("#progressBar").css("width","75%");
        $("#progressText").html("75%");
    });
    
    $("#next-3").click(function(){
        $("#fourth").show();
        $("#third").hide();
        $("#progressBar").css("width","100%");
        $("#progressText").html("100%");
    });

});