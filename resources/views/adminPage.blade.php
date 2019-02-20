<?php
$usersNbr = count($users);
?>

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <h3>you are admin</h3>
    <h5><a href="{{ route('register') }}">{{ __('ajouter un utilisateur') }}</a></h5>
    <h5><a href="http://monappli:3232/ajout_fournisseur">Ajouter un fournisseur</a></h5>
    <h6>Liste utilisateurs</h6>  
    <table id="tableAdmin" class="display" style="width:100%">
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
                    <button type="button" class="btn btn-primary btn-equa" data-toggle="modal" data-target="#exampleModalCenter{{$users[$i]->id}}">Modifier</button>
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
                    <form method="post" action="/user/suppression"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button name="btn-supp-user" id="btn-supp-user" value="{{$users[$i]->id}}" class="btn btn-danger btn-equa">Supprimer</button></form>
                </td>

            </tr>
            @endfor
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Groupe</th>
                <th scope="col">Action</th>
            </tr>
        </tfoot>
    </table>


</div>
@endsection