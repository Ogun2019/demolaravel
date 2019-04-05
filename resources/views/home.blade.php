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
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  -->
@endpush
@extends('layouts.app')
@section('content')
<div id="testblur">
    <input id="csrftoken" type="hidden" value="{{ csrf_token() }}"/>
    <input id="rights" type="hidden" value="{{$rights}}"/>
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
                        <!--<button type="submit" id="saveEdit" value="{{ csrf_token() }}">Savedatatable</button>-->
                        <table id="tableHome" class="ui blue celled table selectable nowrap unstackable table-editable" style="width: 100%;">
                            <thead>
                                <tr>
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
                                    <!--<th class="search-sort" scope="col">F1</th>
                                    <th class="search-sort" scope="col">F2</th>
                                    <th class="search-sort" scope="col">F3</th>
                                    <th class="search-sort" scope="col">F4</th>-->
                                    <th class="search-sort" scope="col">Quantités PLV commandables</th>
                                    <th class="search-sort" scope="col">Date livraison logitoys n° semaine</th>
                                    <th class="search-sort" scope="col">Commentaire PLV</th>
                                    <th class="search-sort" scope="col">Contact pour commande PLV</th>
                                    <th class="search-sort" scope="col">Type PLV</th>
                                    <th class="search-sort" scope="col">Date commande PLV</th>
                                    <th class="search-sort" scope="col">N° de commande PLV</th>
                                    <th class="search-sort" scope="col">Date de livraison logitoys PLV</th>
                                    <th class="search-sort" scope="col">Action paramétrée</th>
                                    <th class="search-sort" scope="col">N° action FR</th>
                                    <th class="search-sort" scope="col">N° action BE</th>
                                    <th class="search-sort" scope="col">N° action LU</th>
                                    <th class="search-sort" scope="col">N° action CH</th>
                                    <th class="search-sort" scope="col">N° action IT</th>
                                    <th>Validité</th>
                                    @if($rights==="true")
                                    <th class="nosort">Actions</th>
                                    @endif
                                    <!--<th scope="col">Validité</th>
                                    <th scope="col">Exclusion</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
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
                                    <!--<th class="search-sort" scope="col">F1</th>
                                    <th class="search-sort" scope="col">F2</th>
                                    <th class="search-sort" scope="col">F3</th>
                                    <th class="search-sort" scope="col">F4</th>-->
                                    <th class="search-sort" scope="col">Quantités PLV commandables</th>
                                    <th class="search-sort" scope="col">Date livraison logitoys n° semaine</th>
                                    <th class="search-sort" scope="col">Commentaire PLV</th>
                                    <th class="search-sort" scope="col">Contact pour commande PLV</th>
                                    <th class="search-sort" scope="col">Type PLV</th>
                                    <th class="search-sort" scope="col">Date commande PLV</th>
                                    <th class="search-sort" scope="col">N° de commande PLV</th>
                                    <th class="search-sort" scope="col">Date de livraison logitoys PLV</th>
                                    <th class="search-sort" scope="col">Action paramétrée</th>
                                    <th class="search-sort" scope="col">N° action FR</th>
                                    <th class="search-sort" scope="col">N° action BE</th>
                                    <th class="search-sort" scope="col">N° action LU</th>
                                    <th class="search-sort" scope="col">N° action CH</th>
                                    <th class="search-sort" scope="col">N° action IT</th>
                                    <th>Validité</th>
                                    @if($rights==="true")
                                    <th class="nosort">Actions</th>
                                    @endif
                                    <!--<th scope="col">Validité</th>
                                    <th scope="col">Exclusion</th>-->
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
</div>
<!-- Modal sauvegarde vue-->
<!-- Modal -->
<div class="modal fade" id="saveModalCenter" tabindex="-1" role="dialog" aria-labelledby="saveModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Sauvegarde de l'affichage</h5>
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
<script>
$('.table-editable').find('td').each(function () {
    if ($(this).attr("contentEditable") == "true") {
        $(this).click(function () {
            $('.table-editable td').not($(this)).prop('contenteditable', false);
            $(this).prop('contenteditable', true);
        });
        $(this).blur(function () {
            $(this).prop('contenteditable', false);
        });
    }
});
</script>
@endsection 