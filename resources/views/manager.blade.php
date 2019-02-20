<?php
$nbrassistant = count($assistant);
$nbrfourni = count($fourni);
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 bg-light p-6 rounded mt-5">
            <h5 class="text-center text-light bg-success mb-2 p-2 rounded lead" id="result">multi-step</h5>
            <!--<div class="progress mb-3" style="height:28px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" role="progressbar" style="width: 20%;" id="progressBar">
                    <b class="lead" id="progressText">Étape-1</b>
                </div>    
            </div>-->
            <form action="" method="post" enctype="multipart/form-data" id="form-data">
                <div class="card mb-3">
                    <div class="card-body">
                        <div id="first">
                            <h4 class="text-center p-1">Étape 1</h4>
                            <hr>
                            <div class="form-row">
                                <div class="col">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label for="managerName" class="required">Category manager :</label>
                                    <select class="form-control required" id="manager" name="managerName" onchange="giveSelection(this.value)">
                                        <option value="">Selectionner un manager</option>
                                        @for($i=0;$i<$manager->count();$i++)
                                        <option groupe='{{$manager[$i]->name}}' value="{{$manager[$i]->groupe}}">{{$manager[$i]->name}}</option>
                                        @endfor
                                        <input type='hidden' id="grp" name="grp" value="" />
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="assistant" class="required">Assistant :</label>
                                    <select name="assistantName" class="form-control" id="assistant" required>
                                        @for($i=0;$i<$nbrassistant;$i++)
                                        <option data-option="{{$assistant[$i]->groupe}}">{{$assistant[$i]->name}}</option>
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
                                        <option value="{{$fourni[$i]->fournisseur_nom}}" >{{$fourni[$i]->fournisseur_nom}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="intituleAction" class="required">Intitulé de l'action :</label>
                                    <input name="intituleAction" type="text" class="form-control" id="intituleAction" placeholder="Ex : Play Doh deuxième à -50%">
                                    <b class="form-text text-danger" id="intituleActionError" ></b>
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
                                    <label for="epuisement" class="required">Jusqu'a épuisement oui/non :</label>
                                    <input class="form-control" id="epuisement" name="epuisement" type="text" placeholder="oui / non">
                                    <b class="form-text text-danger" id="epuisementError" ></b>
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
                            <h4 class="text-center p-1">Étape 2</h4>
                            <hr>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="valableFr" >Valable en France oui/non :</label>
                                    <input class="form-control" name="valableFr" id="valableFr" type="text" placeholder="oui / non" required>
                                    <b class="form-text text-danger" id="valableFrError" ></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="valableBe">Valable en Belgique oui/non :</label>
                                    <input class="form-control" id="valableBe" name="valableBe" type="text" placeholder="oui / non" required>
                                    <b class="form-text text-danger" id="valableBeError" ></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="valableLux">Valable en Luxembourg oui/non :</label>
                                    <input class="form-control" name="valableLux" id="valableLux" type="text" placeholder="oui / non" required>
                                    <b class="form-text text-danger" id="valableLuxError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="valableSui">Valable en Suisse oui/non :</label>
                                    <input class="form-control" id="valableSui" name="valableSui" type="text" placeholder="oui / non" required>
                                    <b class="form-text text-danger" id="valableSuiError" ></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="valableIt">Valable en Italie oui/non :</label>
                                    <input class="form-control" type="text" id="valableIt" name="valableIt" placeholder="oui / non" required>
                                    <b class="form-text text-danger" id="valableItError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="presenceCat">Présence catalogue oui/non (préciser) :</label>
                                    <input class="form-control" type="text" id="presenceCat" name="presenceCat" placeholder="oui / non (préciser)" required>
                                    <b class="form-text text-danger" id="presenceCatError"></b>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-danger" id="prev-2">Précédent</a>
                                <a href="#" class="btn btn-primary" id="next-2">Suivant</a>
                            </div>
                        </div>
                        <div id="third">
                            <h4 class="text-center p-1">Étape 3</h4>
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
                                    <select class="custom-select" name="remise" id="remise" required>
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
                            <h4 class="text-center p-1">Étape 4</h4>
                            <hr>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="plvFournisseur" class="required">PLV Fournisseur oui/non :</label>
                                    <input class="form-control" id="plvFournisseur" type="text" name="plvFournisseur" placeholder="PLV Fournisseur oui/non" required>
                                    <b class="form-text text-danger" id="plvFournisseurError"></b>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="detailplvFournisseur">Détail PLV Fournisseur : </label>
                                    <input class="form-control" id="detailplvFournisseur" type="text" name="detailplvFournisseur" placeholder="Typologie de PLV : wobblers / A4 / flyers différés ..." required>
                                    <b class="form-text text-danger" id="detailplvFournisseurError"></b>
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
                                <div class="col-md-6 mb-3">
                                    <label for="flyerFile">Lien Visuel Flyer différé:</label><br/>
                                    <input type="file" id="flyerFile" name="flyerFile" size="50">
                                    <p id="demo"></p>
                                </div>
                                <div class="col-md-6 mb-3">
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
        for (var i = 0; i < options2.length; i++) {
            if (options2[i].dataset.option === selectedValue) {
                assistant.appendChild(options2[i]);
            }
        }
    }
    giveSelection(manager.value);

</script>

@endsection
