<?php
setlocale(LC_TIME, "fr_FR");
if (!empty($action)) {
    $nbrAct = count($action);
    $ok = true;
} else {
    $ok = false;
}

$heure = date('H:i');
$date = strftime("%d-%M-%y");
?>

@push('scripts')
<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">-->
@endpush


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="messaging">
        <div>
            <h3 class="text-center p-2">Discussion</h3>
            <div>
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Action</h4>
                    </div>
                </div>
                <div class="inbox_chat">
                    <div class="chat_list active_chat">
                        <div class="chat_people">
                            <div class="chat_ib">
                                <h5>Intitulé de l'action: {{$act[0]->intitule_action}}</h5>
                                <p>Détails de l'action: {{$act[0]->details_action}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mesgs">
                <div class="msg_history">
                    @if($ok)
                    @for($i=0;$i<$nbrAct;$i++)
                    @if(auth()->user()->id != $action[$i]->id_expediteur)
                    <div class="incoming_msg p-2">
                        <div class="incoming_msg_img"> <img class="img-fluid" src="/svg/user.png" alt="userImage"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>{{$action[$i]->commentaire}}</p>
                                <span class="time_date">Envoyé à {{date("H:i", strtotime($action[$i]->date_message))}}    |    {{date("d-m-Y", strtotime($action[$i]->date_message))}} par {{ucfirst($action[$i]->name)}} email: {{$action[$i]->email}}</span></div>
                        </div>
                    </div>
                    @else
                    <div class="outgoing_msg p-2">
                        <div class="sent_msg">
                            <p>{{$action[$i]->commentaire}}</p>
                            <span class="time_date">Envoyé à {{date("H:i", strtotime($action[$i]->date_message))}}    |    {{date("d-m-Y", strtotime($action[$i]->date_message))}} par {{ucfirst($action[$i]->name)}} email: {{$action[$i]->email}}</span>
                        </div>
                    </div>
                    @endif
                    @endfor
                    @endif
                </div>
                <form action="/sendComment" method="post">
                    <div class="type_msg">
                        <div class="input_msg_write p-2">
                            @csrf
                            <input type="text" name="d_commentaire" class="write_msg" placeholder="Commentaire..." />
                            <input type="hidden" name="idaction" value="{{$act[0]->id_achat_details}}"/>
                            <button class="btn btn-primary position-absolute msg_send_btn" name="btn-comment-userid" value="{{auth()->user()->id}}" type="submit">Envoyer</button>
                        </div>
                    </div>
                </form>    
            </div>
        </div>

    </div></div>
@endsection