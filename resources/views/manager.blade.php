<?php
$nbrassistant = count($assistant);
$nbrfourni = count($fourni);
$actionsNbr = count($actions);
$nbruserg = count($usergroupe);
?>
@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/localization/messages_fr.js"></script>
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />-->
<link rel="stylesheet" href="css/easy-autocomplete.min.css"/>
<script src="js/jquery.easy-autocomplete.min.js"></script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-6 rounded mt-5">
            <h5 class="text-center text-light bg-success mb-2 p-2 rounded lead" id="result">multi-step</h5>
            <div class="progress mb-3" style="height:28px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" role="progressbar" style="width: 20%;" id="progressBar">
                    <b class="lead" id="progressText">25%</b>
                </div>    
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card mb-3">
                    <div class="card-body">
                        <div id="first">
                            <h4 class="text-center p-1">Achat/détails des offres - Étape 1/4</h4>
                            <hr>
                            <div class="form-row">
                                <!--<div class="col-12">
                                    <label for="numaction" class="required">N° action</label>
                                    <input name="numaction" type="number" class="form-control" id="numaction" placeholder="Le dernier n° est {{$achat[0]->nbraction}}">
                                </div>-->
                                <div class="col">
                                    <label for="managerName" class="required">Category manager :</label>
                                    <select class="form-control required" id="manager" name="managerName" onchange="giveSelection(this.value)">
                                        <option value="">Selectionner un manager</option>
                                        @for($i=0;$i<$manager->count();$i++)
                                        <option groupe='{{$manager[$i]->id}}' value="{{$manager[$i]->id}}">{{$manager[$i]->name}}</option>
                                        @endfor
                                        <input type='hidden' id="grp" name="grp" value="" />
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="assistant">Assistant :</label>
                                    <select name="assistantName" class="form-control" id="assistant">
                                        @for($i=0;$i<$usergroupe->count();$i++)
                                        <option value="{{$usergroupe[$i]->idass}}" data-option="{{$usergroupe[$i]->supass}}">{{$usergroupe[$i]->nameass}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="fournisseur" class="required">Fournisseur :</label>
                                    <select class="custom-select" id="fournisseur" name="fournisseur" required>
                                        <option selected="" value="" >Sélectionner un fournisseur</option>
                                        @for($i=0;$i<$nbrfourni;$i++)
                                        <option value="{{$fourni[$i]->id_fournisseur}}" >{{$fourni[$i]->fournisseur_nom}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="intituleAction" class="required">Intitulé de l'action :</label>
                                    <select class="custom-select" id="intituleAction" name="intituleAction" required>
                                        <option selected="" value="" >Sélectionner l'intitulé de l'action</option>
                                        @for($i=0;$i<$actionsNbr;$i++)
                                        <option value="{{$actions[$i]->id_action}}" >{{$actions[$i]->nom_action}}</option>
                                        @endfor
                                    </select>
                                    <!--<label for="intituleAction" class="required">Intitulé de l'action :</label>
                                    <input name="intituleAction" type="text" class="form-control" id="intituleAction" placeholder="Ex : Play Doh deuxième à -50%">
                                    <b class="form-text text-danger" id="intituleActionError" ></b>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">

                                    <label for="dated" class="required" >Date de début :</label>
                                    <input id="dated" type="date" name="dated" min=<?php echo date('Y-m-d'); ?> max="2100-12-31" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="required" for="datef">Date de fin :</label>
                                    <input type="date" id="datef" name="datef" min=<?php echo date('Y-m-d'); ?> max="2100-12-31" class="form-control" required>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="presenceCat">Présence catalogue</label>
                                    <select class="custom-select" id="presenceCat" name="presenceCat" required>
                                        <option selected="" value="" >Sélectionner un catalogue</option>
                                        <option value="C01">C01</option>
                                        <option value="C02">C02</option>
                                        <option value="C03">C03</option>
                                        <option value="C04">C04</option>
                                        <option value="C05">C05</option>
                                        <option value="C06">C06</option>
                                        <option value="C07">C07</option>
                                        <option value="C08">C08</option>
                                        <option value="C09">C09</option>
                                        <option value="C10">C10</option>
                                        <option value="C11">C11</option>
                                        <option value="C12">C12</option>
                                        <option value="Pas en catalogue : instore & web">Pas en catalogue : instore & web</option>
                                        <option value="Exclu web">Exclu web</option>
                                    </select>
                                    <!--<input class="form-control" type="text" id="presenceCat" name="presenceCat" placeholder="oui / non (préciser) Ex: C001 :" required>-->
                                    <b class="form-text text-danger" id="presenceCatError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="numeroSemaine" class="required">N° de semaine du début d'action :</label>
                                    <input type="number" class="form-control" name="numeroSemaine" id="numeroSemaine" placeholder="N° de semaine du début d'action" required>
                                    <b class="form-text text-danger" id="numeroSemaineError" ></b>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-primary" id="next-1">Suivant</a>
                            </div>
                        </div>
                        <div id="second">
                            <h4 class="text-center p-1">Achat/détails des offres - Étape 2/4</h4>
                            <hr>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="valableFr" >Valable en France oui/non :</label><br/>
                                    <!--<input class="form-control" name="valableFr" id="valableFr" type="text" placeholder="oui / non" required>-->
                                    <input type="radio" name="valableFr" id="valableFr" value="Oui">Oui<br/>
                                    <input type="radio" name="valableFr" id="valableFr" value="Non">Non
                                    <b class="form-text text-danger" id="valableFrError" ></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="valableBe">Valable en Belgique oui/non :</label><br/>
                                    <input type="radio" name="valableBe" id="valableBe" value="Oui">Oui<br/>
                                    <input type="radio" name="valableBe" id="valableBe" value="Non">Non
                                    <!--<input class="form-control" id="valableBe" name="valableBe" type="text" placeholder="oui / non" required>
                                    <b class="form-text text-danger" id="valableBeError" ></b>-->
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="valableLux">Valable en Luxembourg oui/non :</label><br/>
                                    <!--<input class="form-control" name="valableLux" id="valableLux" type="text" placeholder="oui / non" required>-->
                                    <input type="radio" name="valableLux" id="valableLux" value="Oui">Oui<br/>
                                    <input type="radio" name="valableLux" id="valableLux" value="Non">Non
                                    <b class="form-text text-danger" id="valableLuxError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="valableSui">Valable en Suisse oui/non :</label><br/>
                                    <!--<input class="form-control" id="valableSui" name="valableSui" type="text" placeholder="oui / non" required>-->
                                    <input type="radio" name="valableSui" id="valableSui" value="Oui">Oui<br/>
                                    <input type="radio" name="valableSui" id="valableSui" value="Non">Non
                                    <b class="form-text text-danger" id="valableSuiError" ></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="valableIt">Valable en Italie oui/non :</label><br/>
                                    <!--<input class="form-control" type="text" id="valableIt" name="valableIt" placeholder="oui / non" required>-->
                                    <input type="radio" name="valableIt" id="valableIt" value="Oui">Oui<br/>
                                    <input type="radio" name="valableIt" id="valableIt" value="Non">Non
                                    <b class="form-text text-danger" id="valableItError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="epuisement" class="required">Jusqu'a épuisement oui/non :</label><br/>
                                    <input type="radio" id="epuisement" name="epuisement" value="Oui">Oui<br/>
                                    <input type="radio" checked="checked" id="epuisement" name="epuisement" value="Non">Non
                                    <!--<input class="form-control" id="epuisement" name="epuisement" type="text" placeholder="oui / non">-->
                                    <b class="form-text text-danger" id="epuisementError" ></b>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-danger" id="prev-2">Précédent</a>
                                <a href="#" class="btn btn-primary" id="next-2">Suivant</a>
                            </div>
                        </div>
                        <div id="third">
                            <h4 class="text-center p-1">Achat/détails des offres - Étape 3/4</h4>
                            <hr>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="detailAction" class="required">Détails et conditions de l'action
                                        bien préciser collection / catégorie / licence et ou références concernées par l'action
                                        préciser également les exclusions si il y en a :</label>
                                    <input class="form-control" id="detailAction" name="detailAction" type="text" placeholder="Détails et conditions de l'action" required>
                                    <b class="form-text text-danger" id="detailActionError"></b>
                                </div>
                                <div class="col-md-6 mb-3 mt-4">
                                    <label for="numPageCat">Numéro de la page en catalogue :</label>
                                    <input id="numPageCat" class="form-control" type="number"name="numPageCat" placeholder="Numéro de la page en catalogue" required>
                                    <b class="form-text text-danger" id="numPageCatError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="offreCadeau" class="required">Si offre cadeau, Quantités limitées ?(quantités à disposition) :</label>
                                    <input class="form-control" id="offreCadeau" type="number" name="offreCadeau" placeholder="Si offre cadeau, Qtés limitées ?(quantités à disposition):">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="remise" class="required">Remise directe ou différée :</label>
                                    <select class="custom-select" name="remise" id="remise" onchange="typeOfRemise(this.value)" required>
                                        <option value="">Selectionner la remise</option>
                                        <option value="Remise directe">Remise directe</option>
                                        <option value="Remise différée">Remise différée</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="interventionMax" class="required">Intervention Maxi Toys/ intervention fournisseur :</label>
                                    <input class="form-control" type="text" id="interventionMax" name="interventionMax" placeholder="préciser le type d'intervention" required="">
                                    <b class="form-text text-danger" id="interventionMaxError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="commentaire" class="required">Commentaire :</label>
                                    <input class="form-control" id="commentaire" type="text" name="commentaire" placeholder="commentaire">
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-danger" id="prev-3">Précédent</a>
                                <a href="#" class="btn btn-primary" id="next-3">Suivant</a>
                            </div>
                        </div>
                        <div id="fourth">
                            <h4 class="text-center p-1">Achat/détails des offres - Étape 4/4</h4>
                            <hr>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="plvFournisseur" class="required">PLV Fournisseur oui/non :</label>
                                    <input class="form-control" id="plvFournisseur" type="text" name="plvFournisseur" placeholder="PLV Fournisseur oui/non" required>
                                    <b class="form-text text-danger" id="plvFournisseurError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    
                                        <label for="detailplvFournisseur">Détail PLV Fournisseur: </label>
                                        <input class="form-control" id="detailplvFournisseur" type="text" name="detailplvFournisseur" placeholder="Typologie de PLV : wobblers / A4 / flyers différés ..." required>
                                        <div id="valeurList">
                                        </div>

                                    
                                    <!--<label for="detailplvFournisseur">Détail PLV Fournisseur : </label>
                                    <input class="form-control" id="detailplvFournisseur" type="text" name="detailplvFournisseur" placeholder="Typologie de PLV : wobblers / A4 / flyers différés ..." required>
                                    <b class="form-text text-danger" id="detailplvFournisseurError"></b>-->
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="required">F1 :</label>
                                    <input class="form-control" id="f1" type="text" name="f1" placeholder="Quelle typologie doit recevoir cette PLV ?">  
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="f2" class="required">F2 :</label>
                                    <input class="form-control" id="f2" type="text" name="f2" placeholder="Quelle typologie doit recevoir cette PLV ?">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="f3" class="required">F3 :</label>
                                    <input class="form-control" id="f3" type="text" name="f3" placeholder="Quelle typologie doit recevoir cette PLV ?">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="f4" class="required">F4 :</label>
                                    <input class="form-control" id="f4" type="text" name="f4" placeholder="Quelle typologie doit recevoir cette PLV ?">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="quantite_plv" class="required">Quantités PLV commandables :</label>
                                    <input class="form-control" id="quantite_plv" type="number" name="quantite_plv" placeholder="Quelles sont les quantités de PLV que le fournisseur nous mets à disposition?">
                                    <b class="form-text text-danger" id="quantite_plvError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_liv_logitoys" class="required">Date livraison logitoys (N° semaine):</label>
                                    <input class="form-control" id="date_liv_logitoys" type="number" name="date_liv_logitoys" placeholder="À quelle date est prévu la livraison de ces PLV ?">
                                    <b class="form-text text-danger" id="date_liv_logitoysError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contactPlv" class="required">Contact pour commande PLV :</label>
                                    <input class="form-control" id="contactPlv" type="text" name="contact_plv" placeholder="À qui doit on passer commande de cette PLV?">
                                    <b class="form-text text-danger" id="contactPlvError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="commentairePlv" class="required">Commentaire PLV :</label>
                                    <input class="form-control" id="commentairePlv" type="text" name="comm_plv" placeholder="Quelle typologie doit recevoir cette PLV ?">
                                </div>
                                <div id="fileupload1" class="col-md-6 mb-3">
                                    <label for="flyerFile">Lien Visuel Flyer différé:</label><br/>
                                    <input type="file" id="flyerFile" name="flyerFile" size="50">
                                    <p id="demo"></p>
                                </div>
                                <div id="fileupload2" class="col-md-6 mb-3">
                                    <label for="plvFile">Lien vers Visuel PLV si provient du fournisseur :</label>
                                    <input type="file" id="plvFile" name="plvFile" size="50" >
                                    <p id="demo"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-danger" id="prev-4">Précédent</a>
                                <button class="btn btn-success" id="valid-form-achat" name="valider" type="submit">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




</div>

<script>
    var options = {
        url: "{{route('autocomplete.fetch')}}",

        getValue: "details_action",

        list: {
            match: {
                enabled: true
            }
        }
    };
    $("#detailplvFournisseur").easyAutocomplete(options);
    $('#detailAction').easyAutocomplete(options);

    /*$("#detailplvFournisseur").autocomplete({
     
     source: //"{{route('autocomplete.fetch')}}"
     });*/


    /*$('#detailplvFournisseur').keyup(function () {
     var query = $(this).val();
     if (query != '')
     {
     var _token = $('input[name="_token"]').val();
     $.ajax({
     url: "{{ route('autocomplete.fetch') }}",
     method: "POST",
     data: {query: query, _token: _token},
     success: function (data) {
     $('#valeurList').fadeIn();
     $('#valeurList').html(data);
     }
     });
     }
     });
     
     $(document).on('click', 'li', function(){
     $('#detailplvFournisseur').val($(this).text());
     $('#valeurList').fadeOut();
     });*/
</script>
<script>
    $('#form-data').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });


    //script pour lier les listes
    $("#manager").change(function () {
        var groupeManager = $('option:selected', this).attr('groupe');
        $('#grp').val(groupeManager);
    });

    var manager = document.querySelector('#manager');
    var assistant = document.querySelector('#assistant');
    var options2 = assistant.querySelectorAll('option');

    function giveSelection(selectedValue) {
        assistant.innerHTML = '';
        assistant.append(new Option());
        for (var i = 0; i < options2.length; i++) {
            if (options2[i].dataset.option === selectedValue) {
                assistant.appendChild(options2[i]);
            }
        }
    }
    giveSelection(manager.value);

    var rem = document.querySelector('#remise');
    function typeOfRemise(valRemise) {
        if (valRemise === "Remise directe") {
            $('#fileupload1').hide();
            $('#fileupload2').hide();

        } else {
            $('#fileupload1').show();
            $('#fileupload2').show();

        }

    }


</script>

@endsection
