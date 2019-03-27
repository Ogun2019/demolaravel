<?php 
$actNbr = count($act);
?>
@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/localization/messages_fr.js"></script>
@endpush
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-6 rounded mt-5">
            <form action="" method="post" enctype="multipart/form-data" id="form-data">
                @csrf
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="text-center p-1">Service communication</h4>
                     
                        <label for="typeplv" class="required">PLV :</label>

                        <select class="form-control required" id="typeplv" onchange="ShowDiv(this.value)" name="typeplv">
                            <option value="">PLV ?</option>
                            <option value="Fournisseur">Fournisseur</option>
                            <option value="Maxi toys">Maxi toys</option>
                        </select>
                        <div id="plvf">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="idact" >Identifiant de l'action</label>
                                    <select class="form-control required" name="idact" id="idact">
                                        @for($i=0;$i<$actNbr;$i++)
                                        <option value="{{$act[$i]->id_achat_details}}">Id: {{$act[$i]->id_achat_details}} | détails action: {{$act[$i]->details_action}}</option>
                                        @endfor
                                    </select>
                                    <!--<input class="form-control" name="idact" id="idact" type="number" required>-->
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="datecplvf" >Date commande</label>
                                    <input class="form-control" name="datecplvf" id="datecomplvf" type="date" required>
                                    <b class="form-text text-danger" id="" ></b>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="numcomf">N° de commande</label>
                                    <input class="form-control" id="numcomf" name="numcomf" type="number" placeholder="N° de commande fournisseur" required>
                                    <b class="form-text text-danger" id="" ></b>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="datelivlogplvf">Date livraison logitoys </label>
                                    <input class="form-control" name="datelivlogplvf" id="datelivlogplvf" type="date" required>
                                    <b class="form-text text-danger" id=""></b>
                                </div>
                            </div>
                        </div> 
                        <button class="btn btn-success" id="valid-form-scommunication" name="valider" type="submit">Valider</button>

                    </div>
                </div>
            </form>
        </div>        
    </div>
</div>
<script>
 /*   if ($('#typeplv').val() == '') {
        $("#plvf").hide();
        $("#plvm").hide();
    }

    var typeplv = document.querySelector('#typeplv');
    function ShowDiv(selectedValue) {
        if (selectedValue == "1") {
            $("#plvf").show();
            $("#plvm").hide();
        } else if (selectedValue == "2") {
            $("#plvm").show();
            $("#plvf").hide();
        } else {
            $("#plvf").hide();
            $("#plvm").hide();
        }

    }*/
</script>    
@endsection
