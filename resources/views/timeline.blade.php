<?php
$achat_details = DB::table('achat_details_des_offres')
        ->join('details_des_offres', 'details_des_offres.id_achat_details_fk', '=', 'achat_details_des_offres.id_achat_details')
        ->join('users as us1', 'us1.id', '=', 'details_des_offres.id_user_fk')
        ->join('users as us2', 'us1.id', '=', 'us2.sup')
        ->join('fournisseur', 'fournisseur.id_fournisseur', '=', 'achat_details_des_offres.fournisseur_id_fk')
        ->select('achat_details_des_offres.*', 'us1.name as nameman', 'us2.name as nameass', 'details_des_offres.*', 'fournisseur.*')
        ->groupBy('id_achat_details')
        ->get();
$actions = json_decode(json_encode($achat_details), True);
?>

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/fullcalendar_1.css') }}"/>
<script src="/js/fullcalendar.js"></script>
<!--<link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}"/>
<script src="/js/fullcalendar.min.js"></script>-->
<script src="/js/locale/fr.js"></script>
<link rel="stylesheet" href="css/scheduler.min.css"/>
<script src="js/scheduler.min.js"></script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div id="calendar" class="col-centered"></div>
                </div>
            </div>
        </div>
    </div>    

    <!-- Modal -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="/editTimeline">
                    @csrf
                    <div class="modal-header">

                        <h4 class="modal-title" id="myModalLabel">Action</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Intitulé</label>
                            <div class="col-sm-10">
                                <input disabled name="title" class="form-control" id="title" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Couleur</label>
                            <div class="col-sm-10">
                                <select name="color" class="form-control" id="color">
                                    <option value="">Sélectionner une couleur</option>
                                    <option style="color:#0071c5;" value="#0071c5">&#9724; Bleu</option>
                                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                    <option style="color:#008000;" value="#008000">&#9724; Vert</option>						  
                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Jaune</option>
                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Rouge</option>
                                    <option style="color:#000;" value="#000">&#9724; Noir</option>

                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id" class="form-control" id="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@auth
<script>  
/*$('#calendar').fullCalendar({
 defaultView: 'year',
 header: {
 left: 'prev,next today',
 center: 'title',
 right: 'year,month3,month,week,basicDay'
 },
 views: {
 week: {
 type: 'basic',
 buttonText: '2 semaines',
 duration: {weeks: 2}
 },
 month3: {
 type: 'basic',
 duration: {months: 3}
 }
 },
 allDayDefault: true,
 eventStartEditable: false,
 lang: 'fr',
 eventLimit: true,
 selectable: false,
 selectHelper: true,
 select: function (start, end) {
 
 $('#ModalAdd #start').val(moment(start).format('DD-MM-YY'));
 $('#ModalAdd #end').val(moment(end).format('DD-MM-YY'));
 $('#ModalAdd').modal('show');
 },
 eventRender: function (event, element) {
 element.bind('click', function () {
 $('#ModalEdit #id').val(event.id);
 $('#ModalEdit #title').val(event.title);
 $('#ModalEdit #color').val(event.color);
 $('#ModalEdit').modal('show');
 });
 },*/
$('#calendar').fullCalendar({
schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        header: {
        left: 'today prev,next',
                center: 'title',
                right: 'timelineDay,timelineTwoWeek,timelineMonth,timelineThreeMonth,timelineYear'
        },
        defaultView: 'timelineThreeMonth',
        views: {
        timelineThreeMonth: {
        type: 'timeline',
                duration: { months: 3 }
        },
                timelineTwoWeek: {
                type: 'timeline',
                        duration: { weeks: 2 }
                },
        },
        allDayDefault: true,
        eventStartEditable: false,
        lang: 'fr',
        eventLimit: true,
        selectable: false,
        selectHelper: true,
        select: function (start, end) {

        $('#ModalAdd #start').val(moment(start).format('DD-MM-YY'));
        $('#ModalAdd #end').val(moment(end).format('DD-MM-YY'));
        $('#ModalAdd').modal('show');
        },
        eventRender: function (event, element) {
        element.bind('click', function () {
        $('#ModalEdit #id').val(event.id);
        $('#ModalEdit #title').val(event.title);
        $('#ModalEdit #color').val(event.color);
        $('#ModalEdit').modal('show');
        });
        },
        events: [
<?php
foreach ($actions as $action):

    $start = explode(" ", $action['date_debut']);
    $end = explode(" ", $action['date_fin']);
    if ($start[1] == '00:00:00') {
        $start = $start[0];
    } else {
        $start = $action['date_debut'];
    }
    if ($end[1] == '00:00:00') {
        $end = $end[0];
        /* $end[1] = '23:00:00';
          $end = $end[0] . " " . $end[1]; */
    } else {
        $end = $action['date_fin'];
    }
    $start1 = date("d-m", strtotime($start));
    $end1 = date("d-m", strtotime($end));

    $time = strtotime($end);
    $date1 = str_replace('-', '/', $end);
    $end = date('Y-m-d', strtotime($date1 . "+1 days"));
    ?>
            {
            id: '<?php echo $action['id_achat_details']; ?>',
                    title: '<?php echo " id :" . $action['id_achat_details'] . " " . $action['intitule_action'] . " " . $start1 . "/" . $end1 . " " . "cat: " . $action['presence_cat']; ?>',
                    start: '<?php echo $start; ?>',
                    end: '<?php echo $end; ?>',
                    color: '<?php echo $action['color']; ?>'
            },
<?php endforeach; ?>
        ]
        });
/*$('.fc-month-button ').text("Mois");
 $('.fc-basicWeek-button').text("Semaine");
 $('.fc-basicDay-button').text("Jour");
 $('.fc-today-button').text("Aujourd'hui");*/
</script>
@else
<script>
    $('#calendar').fullCalendar({
    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            header: {
            left: 'today prev,next',
                    center: 'title',
                    right: 'timelineDay,timelineTwoWeek'
            },
            defaultView: 'timelineTwoWeek',
            views: {
            timelineTwoWeek: {
            type: 'timeline',
                    duration: { weeks: 2 }
            },
            },
            eventStartEditable: false,
            lang: 'fr',
            eventLimit: true,
            selectable: false,
            selectHelper: false,
            events: [
<?php
foreach ($actions as $action):

    $start = explode(" ", $action['date_debut']);
    $end = explode(" ", $action['date_fin']);
    if ($start[1] == '00:00:00') {
        $start = $start[0];
    } else {
        $start = $action['date_debut'];
    }
    if ($end[1] == '00:00:00') {
        $end = $end[0];
    } else {
        $end = $action['date_fin'];
    }
    ?>
                {
                id: '<?php echo $action['id_achat_details']; ?>',
                        title: '<?php echo $action['intitule_action']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $end; ?>',
                        color: '<?php echo $action['color']; ?>'
                },
<?php endforeach; ?>
            ]
    });
</script>
@endauth
@endsection