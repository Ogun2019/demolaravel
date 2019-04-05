<?php ?>

@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" />
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title mb-4">
                        <form id="formuProfile" action="/user/saveProfile" method="post" enctype="multipart/form-data">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    @csrf
                                    @if(Auth::user()->profileImage == null)
                                    <img src="http://placehold.it/150x150" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                    @else
                                    <img src="../storage/{{Auth::user()->profileImage}}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                    @endif
                                    <div class="middle">
                                        <input type="button" class="btn btn-secondary" id="btnChangePicture" value="modifier" />
                                        <input type="file" style="display: none;" id="profilePicture" name="profilePicture"/>
                                    </div>
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">{{ucfirst(Auth::user()->name)}}</a></h2>
                                </div>
                                <div class="ml-auto">

                                    <input type="button" class="btn btn-primary d-none" id="btnSave" value="Sauver" />
                                </div>
                            </div>
                        </form>    
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Informations</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#parametre" role="tab" aria-controls="parametre" aria-selected="false">Paramètres</a>
                                </li>
                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Id</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{Auth::user()->id}}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Nom</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{Auth::user()->name}}
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Email</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{Auth::user()->email}}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Rôle</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{Auth::user()->type}}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Crée le</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{date("d/m/Y", strtotime(Auth::user()->created_at))}}
                                        </div>
                                    </div>
                                    <hr />

                                </div>
                                <div class="tab-pane fade" id="parametre" role="tabpanel" aria-labelledby="parametre-tab">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" id="notif" name="notif">
                                        <label>Activer les notifications email</label>
                                    </div>
                                    <br/>
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" id="notifTime" name="notifTime">
                                        <label>Recevoir les notifications en temps réel</label>
                                        <input type="hidden" id="iduser" name="iduser" value="{{Auth::user()->id}}">
                                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
<script>
    /*
     * load data to the checkbox(switch) from database
     */
    $.ajax({
    url: '/user/profile',
            method: 'get',
            success: function () {
            var userinfo = {!! json_encode($userinfo -> toArray(), JSON_HEX_TAG) !!};
            userinfoN = JSON.stringify(userinfo[0].notification);
            userinfoNt = JSON.stringify(userinfo[0].notification_time);
            //alert(userinfo);
            if (userinfoN == '"checked"') {
            $("#notif").prop("checked", true);
            if (userinfoNt == '"true"') {
            $("#notifTime").prop("checked", true);
            } else {
                $("#notifTime").prop("checked", false);
            }

            //alert("true");
            } else {
            $('#notif').prop("checked", false);
            document.getElementById("notifTime").disabled = true;
            //alert('false');
            }

            }
    });
    /*
     * save user choice (checkbox)
     */
    $("#notif").change(function () {
    if (this.checked) {
    var valeur = "checked";
    $('#notifTime').attr('disabled', false);
    } else {
    $("#notifTime").disabled = true;
    var valeur = "unchecked";
    $('#notifTime').attr('disabled', true);
    }
    var userid = $('#iduser').val();
    var token = $('#_token').val();
    $.ajax({
    'url': '/user/saveNotifParam',
            'data': {_token: token, valeur: valeur, userid: userid},
            'dataType': 'json',
            'method': 'POST',
            "success": function () {

            }
    });
    });
    /*
     * Save user notiftime choice
     */
    $("#notifTime").change(function () {
    if (this.checked) {
    var valeur = "true";
    } else {
    $("#notifTime").disabled = true;
    var valeur = "false";
    }
    var userid = $('#iduser').val();
    var token = $('#_token').val();
    $.ajax({
    'url': '/user/saveNotifTimeParam',
            'data': {_token: token, valeur: valeur, userid: userid},
            'dataType': 'json',
            'method': 'POST',
            "success": function () {
            }
    });
    });
    /* profile utilisateur */
    $imgSrc = $('#imgProfile').attr('src');
    function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    $('#imgProfile').attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
    }
    }
    $('#btnChangePicture').on('click', function () {

    if (!$('#btnChangePicture').hasClass('changing')) {
    $('#profilePicture').click();
    } else {
    $('#profilePicture').click();
    }
    });
    $('#profilePicture').on('change', function () {
    readURL(this);
    $('#btnChangePicture').addClass('changing');
    $('#btnSave').attr('value', 'Sauver').removeClass('d-none');
    });
    $('#btnSave').on('click', function () {
    $('#formuProfile').submit();
    });

</script>
@endsection