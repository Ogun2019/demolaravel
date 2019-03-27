<?php
use App\User;
$usersNbr = count($users);
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
    <!--<a href="{{ route('register') }}"><img style="width: 44px; height:44px;" src="/svg/add_user.png" alt="add_user"></a>-->
    <h2>Liste des utilisateurs</h2>  
    <div onclick="location.href ='{{ route('register') }}'" class="ui left floated small primary labeled icon button" tabindex="0">
        <i class="user icon"></i> Ajouter un utilisateur
    </div>
    <table id="tableAdmin" class="ui table" style="width:100%">

        <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Rôle</th>
                <th scope="col">Nom du manager</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<$usersNbr;$i++)
            <tr id="a{{$users[$i]->id}}">   
                <th scope="row">{{$i+1}}</th>
                <th scope="row">{{$users[$i]->id}}</th>
                <td>{{$users[$i]->name}}</td>
                <td>{{$users[$i]->email}}</td>
                <td data-target="role">{{$users[$i]->type}}</td>
                <td data-target="groupe">{{User::find($users[$i]->sup)['name']}}</td>
                <td>
                    <div class="input-group">
                        <button type="button" class="btn btn-link item p-0 btn-modif-edit" data-toggle="modal" data-id="a{{$users[$i]->id}}" data-target="#exampleModalCenter{{$users[$i]->id}}"><img src="/svg/edit.png" alt="edit_user"></button>

                        <!-- modal bouton modifier -->
                        <div class="modal fade" id="exampleModalCenter{{$users[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modifier les droits de l'utilisateur</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="http://monappli:3232/user/update" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="modal-body">
                                            <!--@if ($users[$i]->type==='assistant')
                                            <div class="col-md-6 mb-3 supper">
                                                <label for="type">{{ __('Identifiant du manager') }}</label>
                                                <input id="idsup" type="text" class="form-control{{ $errors->has('idsup') ? ' is-invalid' : '' }}" name="idsup">
                                                @if ($errors->has('idsup'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('idsup') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            @endif-->
                                            <div class="col-md-6 mb-3">
                                                <label for="type">{{ __('Nouveau rôle :') }}</label>
                                                <select class="form-control type testtype" id="type" name="type" required="">
                                                    <option selected="" value="" >Sélectionner un rôle</option>                                                   
                                                    <option value="manager" >Manager</option>
                                                    <option value="assistant" >Assistant</option>
                                                    <option value="serviceclient" >Service client</option>
                                                    <option value="servicecomm" >Service communication</option>
                                                    <option value="web" >Web</option>
                                                </select>
                                            </div>
                                            <div style="display: none;" class="col-md-6 mb-3">
                                                <label for="groupe">{{ __('Nouveau groupe') }}</label>
                                                <select class="form-control" id="groupe" name="groupe">
                                                    <option selected="" value="" >Sélectionner un groupe</option>                                                   
                                                    <option value="1" >1</option>
                                                    <option value="2" >2</option>
                                                    <option value="3" >3</option>
                                                    <option value="4" >4</option>
                                                    <option value="5" >5</option>
                                                </select>                            
                                            </div>
                                            <div  style="display:none;" class="col-md-6 mb-3 supper">
                                                <label for="type">{{ __('Identifiant du manager') }}</label>
                                                <input id="idsup" type="text" class="form-control{{ $errors->has('idsup') ? ' is-invalid' : '' }}" name="idsup">
                                                @if ($errors->has('idsup'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('idsup') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            <button type="submit" name="modifUser" value="{{$users[$i]->id}}" class="btn btn-primary">Mettre à jour</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if ($users[$i]->type==='assistant' or $users[$i]->type==='manager')
                        <form onsubmit="return confirm('Attention! Vous êtes en train de supprimer un utilisateur. Toutes les actions lier à cet utilisateur doivent aussi être supprimer.');" method="post" action="/user/suppression"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button name="btn-supp-user" id="btn-supp-user" value="{{$users[$i]->id}}" class="btn btn-link item p-0"><img src="/svg/delete.png" alt="delete_user"></button></form>
                        @else
                        <form onsubmit="return confirm('Attention! Vous êtes en train de supprimer un utilisateur.');" method="post" action="/user/suppression"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button name="btn-supp-user" id="btn-supp-user" value="{{$users[$i]->id}}" class="btn btn-link item p-0"><img src="/svg/delete.png" alt="delete_user"></button></form>
                        @endif
                    </div>
                </td>
            </tr>
            @endfor
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Rôle</th>
                <th scope="col">Id du manager</th>
                <th scope="col">Action</th>
            </tr>
        </tfoot>
    </table>

</div>

<script>
    $('.modal').on('hidden', function () {
        $(".supper").hide();
    });

    $(".testtype").on("change", function () {
        if ($(this).val() === "assistant") {
            $(".supper").show();
        } else {
            $(".supper").hide();
        }
    });


</script>
@endsection