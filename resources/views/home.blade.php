<?php
$achatNbr = count($achat);
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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Accueil</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <br/>
                    <h1>Achats / détails des offres</h1>
                    <label for="min" class="col-1">Date min :</label>
                    <input autocomplete="off"  type="text" id="min" name="min" /><br/>
                    <label for="max" class="col-1">Date max :</label>
                    <input autocomplete="off"  type="text" id="max" name="max" />
                    <table id="tableHome" class="display" style="width:100%" >
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Id</th>
                                <th scope="col">Date</th>
                                <th scope="col">Category Manager</th>
                                <th scope="col">Assistant</th>
                                <th scope="col">Fournisseur</th>
                                <th scope="col">Intitule action</th>
                                <th scope="col">N° de semaine du début d'action</th>
                                <th scope="col">Date de début de l'action</th>
                                <th scope="col">Date de fin de l'action</th>
                                <th scope="col">Épuisement</th>
                                <th scope="col">Valable en France</th>
                                <th scope="col">Valable en Belgique</th>
                                <th scope="col">Valable en Luxembourg</th>
                                <th scope="col">Valable en Suisse</th>
                                <th scope="col">Valable en Italie</th>
                                <th scope="col">Présence en catalogue ou non</th>
                                <th scope="col">Numero de la page en catalogue</th>
                                <th scope="col">Détails et condition de l'action</th>
                                <th scope="col">Offre cadeau</th>
                                <th scope="col">Remise directe ou différée</th>
                                <th scope="col">Intervention Maxi Toys / fournisseur</th>
                                <th scope="col">Plv fournisseur</th>
                                <th scope="col">Commentaire</th>
                                @if(Auth::user()->type=='manager' or Auth::user()->type=='assistant' or Auth::user()->type=='admin')<th scope="col">Action</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0;$i<$achatNbr;$i++)
                            <tr>
                                <th scope="row">{{$i+1}}</th>
                                <td>{{$achat[$i]->id_achat_details}}</td>
                                <td>{{date("d/m/Y", strtotime($achat[$i]->date))}}</td>
                                <td>{{$achat[$i]->category_manager}}</td>
                                <td>{{$achat[$i]->assistant}}</td>
                                <td>{{$achat[$i]->fournisseur}}</td>
                                <td>{{$achat[$i]->intitule_action}}</td>
                                <td>{{$achat[$i]->numero_semaine}}</td>
                                <td>{{date("d/m/Y", strtotime($achat[$i]->date_debut))}}</td>
                                <td>{{date("d/m/Y", strtotime($achat[$i]->date_fin))}}</td>
                                <td>{{$achat[$i]->epuisement}}</td>
                                <td>{{$achat[$i]->valable_fr}}</td>
                                <td>{{$achat[$i]->valable_be}}</td>
                                <td>{{$achat[$i]->valable_lux}}</td>
                                <td>{{$achat[$i]->valable_sui}}</td>
                                <td>{{$achat[$i]->valable_it}}</td>
                                <td>{{$achat[$i]->presence_cat}}</td>
                                <td>{{$achat[$i]->num_page_cat}}</td>
                                <td>{{$achat[$i]->details_action}}</td>
                                <td>{{$achat[$i]->offre}}</td>
                                <td>{{$achat[$i]->remise}}</td>
                                <td>{{$achat[$i]->intervention}}</td>
                                <td>{{$achat[$i]->plv_fournisseur}}</td>
                                <td>{{$achat[$i]->commentaire}}</td>
                                @if(Auth::user()->type=='manager' or Auth::user()->type=='assistant' or Auth::user()->type=='admin')<td>
                                    <button type="button" class="btn btn-primary btn-equa" data-toggle="modal" data-target="#exampleModalCenter{{$achat[$i]->id_achat_details}}">Modifier</button>
                                    <form method="post" action="/achat/suppression"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button name="btn-supp-achat" id="btn-supp-achat" value="{{$achat[$i]->id_achat_details}}" class="btn btn-danger btn-equa">Supprimer</button></form>
                                </td>@endif
                                <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter{{$achat[$i]->id_achat_details}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Nouvelle date de fin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="http://monappli:3232/achat/updateAchat" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="modal-body">
                                            <div class="col-md-6 mb-3">
                                                <label >Date de fin :</label>
                                                <input type="date" name="datef" min=<?php echo date('Y-m-d'); ?> max="2100-12-31" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            <button type="submit" name="modifAchatid" value="{{$achat[$i]->id_achat_details}}" class="btn btn-primary">Mettre à jour</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </tr>
                        @endfor
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Id</th>
                                <th scope="col">Date</th>
                                <th scope="col">Category Manager</th>
                                <th scope="col">Assistant</th>
                                <th scope="col">Fournisseur</th>
                                <th scope="col">Intitule action</th>
                                <th scope="col">N° de semaine du début d'action</th>
                                <th scope="col">Date de début de l'action</th>
                                <th scope="col">Date de fin de l'action</th>
                                <th scope="col">Épuisement</th>
                                <th scope="col">Valable en France</th>
                                <th scope="col">Valable en Belgique</th>
                                <th scope="col">Valable en Luxembourg</th>
                                <th scope="col">Valable en Suisse</th>
                                <th scope="col">Valable en Italie</th>
                                <th scope="col">Présence en catalogue ou non</th>
                                <th scope="col">Numero de la page en catalogue</th>
                                <th scope="col">Détails et condition de l'action</th>
                                <th scope="col">Offre cadeau</th>
                                <th scope="col">Remise directe ou différée</th>
                                <th scope="col">Intervention Maxi Toys / fournisseur</th>
                                <th scope="col">Plv fournisseur</th>
                                <th scope="col">Commentaire</th>
                                @if(Auth::user()->type=='manager' or Auth::user()->type=='assistant' or Auth::user()->type=='admin')<th scope="col">Action</th>@endif
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection