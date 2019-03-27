<?php
$logsNbr = count($logs);
?>

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css" />
<script type="text/javascript" type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"></script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Logs</h2>  
    <table id="tableLog" class="ui table" style="width:100%">

        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Id utilisateur</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Opération</th>
                <th scope="col">Action id modifié</th>
                <th scope="col">Intitulé action</th>
                <th scope="col">Colonne modifié</th>
                <th scope="col">Modifé par</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<$logsNbr;$i++)
            <tr>   
                <td>{{$logs[$i]->date_a}}</td>
                <td>{{$logs[$i]->id_u}}</td>
                <td>{{$logs[$i]->name_u}}</td>
                <td>{{$logs[$i]->email_u}}</td>
                <td>{{$logs[$i]->type}}</td>
                <td>{{$logs[$i]->action_id}}</td>
                <td>{{$logs[$i]->intitule_a}}</td>
                <td>{{$logs[$i]->colonne_m}}</td>
                <td>{{$logs[$i]->colonne_v}}</td>
            </tr>
            @endfor
        </tbody>
    </table>

</div>


@endsection