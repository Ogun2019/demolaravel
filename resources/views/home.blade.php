<?php

use App\User;
$achatNbr = count($achat);
//$actionParamNbr = count($actionparam);
//$servComNbr = count($servCom);
$webnbr = count($web);
if (Auth::user()->type == 'manager' or Auth::user()->type == 'assistant' or Auth::user()->type == 'admin') {
    $rights = "true";
} else {
    $rights = "false";
}
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
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" ></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" ></script>-->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.html5.min.js" ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js" ></script>
@endpush
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <br/>
                    <h1>Achats / détails des offres</h1>
                    <!--<h4>Filtrer la recherche par date</h4>
                       <div class="input-group">
                           <label for="min">Date minimum: </label>
                           <input onclick="" class="form-control col-md-2" placeholder="Selectionner une date" autocomplete="off"  type="search" id="min" name="min" />&nbsp;
                           <label for="max">Date maximum: </label>
                           <input class="form-control col-md-2" placeholder="Selectionner une date" autocomplete="off"  type="search" id="max" name="max" />
                       </div>
                       <br/>-->
                    <label for="exampleFormControlSelect1">Selectionner l'affichage</label>
                    <select class="form-control w-25 mb-2" id="exampleFormControlSelect1">
                        @foreach($afftable as $aff)
                        <option value="{{$aff->name}}">{{$aff->name}}</option>
                        @endforeach
                    </select>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Enregistrement de l'affichage</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="nomVue">Nom de la vue</label>
                                    <input type="text" class="form-control" id="nomVue" name="nomVue">
                                    <input type="hidden" id="iduser" value="{{auth()->user()->id}}" name="iduser">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="button" id="saveEdit" value="{{ csrf_token() }}" class="btn btn-primary">Valider</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<button type="submit" id="saveEdit" value="{{ csrf_token() }}">Savedatatable</button>-->
                    <table id="tableHome" class="ui blue celled table selectable nowrap unstackable table-editable">
                        <thead>
                            <tr>
                                @if($rights==="true")
                                <th scope="col">Actions</th>
                                @endif
                                <!--<th class="search-sort" scope="col">N°</th>-->
                                <th class="search-sort" scope="col">Id</th>
                                <th class="search-sort" scope="col">Date</th>
                                <th class="search-sort" scope="col">Category Manager/junior</th>
                                <th class="search-sort" scope="col">Assistant</th>
                                <th class="search-sort" scope="col">Fournisseur</th>
                                <th class="search-sort" scope="col">Intitule action</th>
                                <th class="search-sort" scope="col">N° de semaine du début d'action</th>
                                <th class="search-sort" scope="col">Date de début de l'action</th>
                                <th class="search-sort" scope="col">Date de fin de l'action</th>
                                <th class="search-sort" scope="col">Épuisement</th>
                                <th class="search-sort" scope="col">Valable en France</th>
                                <th class="search-sort" scope="col">Valable en Belgique</th>
                                <th class="search-sort" scope="col">Valable en Luxembourg</th>
                                <th class="search-sort" scope="col">Valable en Suisse</th>
                                <th class="search-sort" scope="col">Valable en Italie</th>
                                <th class="search-sort" scope="col">Présence en catalogue ou non</th>
                                <th class="search-sort" scope="col">Numero de la page en catalogue</th>
                                <th class="search-sort" scope="col">Détails et condition de l'action</th>
                                <th class="search-sort" scope="col">Offre cadeau</th>
                                <th class="search-sort" scope="col">Remise directe ou différée</th>
                                <th class="search-sort" scope="col">Intervention Maxi Toys / fournisseur</th>
                                <th class="search-sort" scope="col">Plv fournisseur</th>
                                <th class="search-sort" scope="col">Commentaire</th>
                                <th class="search-sort" scope="col">Détails PLV fournisseur</th>
                                <th class="search-sort" scope="col">F1</th>
                                <th class="search-sort" scope="col">F2</th>
                                <th class="search-sort" scope="col">F3</th>
                                <th class="search-sort" scope="col">F4</th>
                                <th class="search-sort" scope="col">Quantités PLV commandables</th>
                                <th class="search-sort" scope="col">Date livraison logitoys n° semaine</th>
                                <th class="search-sort" scope="col">Commentaire PLV</th>
                                <th class="search-sort" scope="col">Contact pour commande PLV</th>
                                <th class="search-sort" scope="col">Type PLV</th>
                                <th class="search-sort" scope="col">Date commande PLV</th>
                                <th class="search-sort" scope="col">N° de commande PLV</th>
                                <th class="search-sort" scope="col">Date de livraison logitoys PLV</th>
                                <th scope="col">Action paramétrée</th>
                                <th scope="col">N° action FR</th>
                                <th scope="col">N° action BE</th>
                                <th scope="col">N° action LU</th>
                                <th scope="col">N° action CH</th>
                                <th scope="col">N° action IT</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ csrf_field() }}
                            @for($i=0;$i<$achatNbr;$i++)
                            <tr>
                                <!-- strstr($achat[$i]->id_assistant_fk, '@', true) -->
                                @if($rights==="true")
                                <td class="d-flex">
                                    <a href="/discussion/{{$achat[$i]->id_achat_details}}"><button name="btnDiscIdact" class="btn btn-link item p-0"><img src="/svg/edit.png" alt="discussion"></button></a>
                                    <!--<button type="button" class="btn btn-link item p-0" data-toggle="modal" data-target="#exampleModalCenter{{$achat[$i]->id_achat_details}}"><img src="/svg/edit.png" alt="edit_user"></button>-->
                                    <form onsubmit="return confirm('Attention! Vous êtes en train de supprimer une action.');" method="post" action="/achat/suppression"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button name="btn-supp-achat" id="btn-supp-achat" value="{{$achat[$i]->id_achat_details}}" class="btn btn-link item p-0"><img src="/svg/delete.png" alt="delete_user"></button></form>
                                </td>
                                @endif
                                <!--<td>{{$achat[$i]->num}}</td>-->
                                <td>{{$achat[$i]->id_achat_details}}</td>
                                <td>{{date("d/m/Y", strtotime($achat[$i]->date_creation))}}</td>
                                <td>{{$achat[$i]->nameman}}</td>
                                <td>{{User::find($achat[$i]->assistant_d)['name']}}</td>
                                <!--<td>{{$achat[$i]->nameass}}</td>-->
                                <td>{{$achat[$i]->fournisseur_nom}}</td>
                                <!--<td class="column_namep" data-column_name="intitule_action" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->intitule_action}}</td>-->
                                <td>{{$achat[$i]->nom_action}}</td>
                                <td class="column_namep" data-column_name="numero_semaine" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->numero_semaine}}</td>
                                <td id="dated" class="column_name cold" data-column_name="date_debut" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{date("d/m/Y", strtotime($achat[$i]->date_debut))}}</td>
                                <td id="datef" class="column_name cold" data-column_name="date_fin" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{date("d/m/Y", strtotime($achat[$i]->date_fin))}}</td>
                                <td class="column_namep" data-column_name="epuisement" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->epuisement}}</td>
                                <td class="column_namep" data-column_name="valable_fr" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->valable_fr}}</td>
                                <td class="column_namep" data-column_name="valable_be" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->valable_be}}</td>
                                <td class="column_namep" data-column_name="valable_lux" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->valable_lux}}</td>
                                <td class="column_namep" data-column_name="valable_ch" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->valable_ch}}</td>
                                <td class="column_namep" data-column_name="valable_it" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->valable_it}}</td>
                                <td class="column_namep" data-column_name="presence_cat" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->presence_cat}}</td>
                                <td class="column_namep" data-column_name="num_page_cat" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->num_page_cat}}</td>
                                <td class="column_namep" data-column_name="details_action" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->details_action}}</td>
                                <td class="column_namep" data-column_name="offre" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->offre}}</td>
                                <td class="column_namep" data-column_name="remise" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->remise}}</td>
                                <td class="column_namep" data-column_name="intervention" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->intervention}}</td>
                                <td class="column_namep" data-column_name="plv_fournisseur" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->plv_fournisseur}}</td>
                                <td class="column_namep" data-column_name="commentaire" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->commentaire}}</td>
                                <td class="column_namep" data-column_name="detail_plv_fournisseur" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->detail_plv_fournisseur}}</td>
                                <td class="column_namep" data-column_name="f1" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->f1}}</td>
                                <td class="column_namep" data-column_name="f2" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->f2}}</td>
                                <td class="column_namep" data-column_name="f3" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->f3}}</td>
                                <td class="column_namep" data-column_name="f4" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->f4}}</td>
                                <td class="column_namep" data-column_name="quantite_plv" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->quantite_plv}}</td>
                                <td class="column_namep" data-column_name="date_livraison_logitoys" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->date_livraison_logitoys}}</td>
                                <td class="column_namep" data-column_name="commentaire_plv" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->commentaire_plv}}</td>
                                <td class="column_namep" data-column_name="contact_plv" data-id="{{$achat[$i]->id_achat_details}}" contenteditable="{{$rights}}">{{$achat[$i]->contact_plv}}</td>
                                <td>{{$achat[$i]->type_plv}}</td>
                                <td>{{$achat[$i]->date_co_plvf}}</td>
                                <td>{{$achat[$i]->num_commandef}}</td>
                                <td>{{$achat[$i]->date_liv_logt_plvf}}</td>
                                <td>{{$achat[$i]->actionparam}}</td>
                                <td>{{$achat[$i]->actionFr}}</td>
                                <td>{{$achat[$i]->actionBe}}</td>
                                <td>{{$achat[$i]->actionLu}}</td>
                                <td>{{$achat[$i]->actionCh}}</td>
                                <td>{{$achat[$i]->actionIt}}</td>

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
                                                <input type="date" name="datef" id="datef" min=<?php echo date('Y-m-d'); ?> max="2100-12-31" class="form-control">
                                                <input type="hidden" name="dated" id="dated" value="{{$achat[$i]->date_debut}}">
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
                                @if($rights==="true")
                                <th scope="col">Actions</th>
                                @endif
                                <!--<th class="search-sort" scope="col">N°</th>-->
                                <th class="search-sort" scope="col">Id</th>
                                <th class="search-sort" scope="col">Date</th>
                                <th class="search-sort" scope="col">Category Manager/junior</th>
                                <th class="search-sort" scope="col">Assistant</th>
                                <th class="search-sort" scope="col">Fournisseur</th>
                                <th class="search-sort" scope="col">Intitule action</th>
                                <th class="search-sort" scope="col">N° de semaine du début d'action</th>
                                <th class="search-sort" scope="col">Date de début de l'action</th>
                                <th class="search-sort" scope="col">Date de fin de l'action</th>
                                <th class="search-sort" scope="col">Épuisement</th>
                                <th class="search-sort" scope="col">Valable en France</th>
                                <th class="search-sort" scope="col">Valable en Belgique</th>
                                <th class="search-sort" scope="col">Valable en Luxembourg</th>
                                <th class="search-sort" scope="col">Valable en Suisse</th>
                                <th class="search-sort" scope="col">Valable en Italie</th>
                                <th class="search-sort" scope="col">Présence en catalogue ou non</th>
                                <th class="search-sort" scope="col">Numero de la page en catalogue</th>
                                <th class="search-sort" scope="col">Détails et condition de l'action</th>
                                <th class="search-sort" scope="col">Offre cadeau</th>
                                <th class="search-sort" scope="col">Remise directe ou différée</th>
                                <th class="search-sort" scope="col">Intervention Maxi Toys / fournisseur</th>
                                <th class="search-sort" scope="col">Plv fournisseur</th>
                                <th class="search-sort" scope="col">Commentaire</th>
                                <th class="search-sort" scope="col">Détails PLV fournisseur</th>
                                <th class="search-sort" scope="col">F1</th>
                                <th class="search-sort" scope="col">F2</th>
                                <th class="search-sort" scope="col">F3</th>
                                <th class="search-sort" scope="col">F4</th>
                                <th class="search-sort" scope="col">Quantités PLV commandables</th>
                                <th class="search-sort" scope="col">Date livraison logitoys n° semaine</th>
                                <th class="search-sort" scope="col">Commentaire PLV</th>
                                <th class="search-sort" scope="col">Contact pour commande PLV</th>
                                <th class="search-sort" scope="col">Type PLV</th>
                                <th class="search-sort" scope="col">Date commande PLV</th>
                                <th class="search-sort" scope="col">N° de commande PLV</th>
                                <th class="search-sort" scope="col">Date de livraison logitoys PLV</th>
                                <th scope="col">Action paramétrée</th>
                                <th scope="col">N° action FR</th>
                                <th scope="col">N° action BE</th>
                                <th scope="col">N° action LU</th>
                                <th scope="col">N° action CH</th>
                                <th scope="col">N° action IT</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <br/>
            <br/>
        </div>
    </div>
</div>
@endsection 