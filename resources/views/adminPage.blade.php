<?php
$usersNbr = count($users);
?>

@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-2">
        <div class="container-fluid">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Liste utilisateurs</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Ajouter un utilisateur</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Ajouter un fournisseur</a>
        </div>
            </div>
    </div>
    <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="container">
                    <table id="tableAdmin" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Groupe</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0;$i<$usersNbr;$i++)
                            <tr>
                                <th scope="row">{{$i+1}}</th>
                                <!--<th scope="row">{{$users[$i]->id}}</th>-->
                                <td>{{$users[$i]->name}}</td>
                                <td>{{$users[$i]->email}}</td>
                                <td>{{$users[$i]->type}}</td>
                                <td>{{$users[$i]->groupe}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary col-md-6" data-toggle="modal" data-target="#exampleModalCenter{{$users[$i]->id}}">Modifier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
                                                        <div class="col-md-6 mb-3">
                                                            <label for="type">{{ __('Nouveau rôle') }}</label>
                                                            <input id="name" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                                            @if ($errors->has('type'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('type') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="type">{{ __('Nouveau groupe') }}</label>
                                                            <input id="groupe" type="text" class="form-control" name="groupe" required>                                    
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
                                    <form method="post" action="/user/suppression"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button name="btn-supp-user" id="btn-supp-user" value="{{$users[$i]->id}}" class="btn btn-danger">Supprimer</button></form>
                                </td>

                            </tr>
                            @endfor
                        </tbody>
                    </table>


                </div>

            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"><h5><a href="{{ route('register') }}">{{ __('Ajouter un utilisateur') }}</a></h5></div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"><h5><a href="http://monappli:3232/fournisseur/ajout">Ajouter un fournisseur</a></h5></div>
        </div>
    </div>
</div>
@endsection