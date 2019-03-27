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
                        <h4 class="text-center p-1">Service client</h4>
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
                            <div class="col-md-6 mb-3">
                                <label for="" >Action parametrée</label>
                                <input class="form-control" name="actparam" id="actparam" type="text" placeholder="oui/non" required>
                                <b class="form-text text-danger" id="" ></b>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="actFr">N° action FR</label>
                                <input class="form-control" id="actFr" name="actFr" type="number" placeholder="" required>
                                <b class="form-text text-danger" id="" ></b>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="actBe">N° action BE</label>
                                <input class="form-control" name="actBe" id="actBe" type="number" placeholder="" required>
                                <b class="form-text text-danger" id=""></b>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="actLu">N° action LU</label>
                                <input class="form-control" id="actLu" name="actLu" type="number" placeholder="" required>
                                <b class="form-text text-danger" id="" ></b>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="actCh">N° action CH</label>
                                <input class="form-control" type="number" id="actCh" name="actCh" placeholder="" required>
                                <b class="form-text text-danger" id=""></b>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="actIt">N° action IT</label>
                                <input class="form-control" type="number" id="actIt" name="actIt" placeholder="" required>
                                <b class="form-text text-danger" id=""></b>
                            </div>
                            <button class="btn btn-success" id="valid-form-sclient" name="valider" type="submit">Valider</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>        
    </div>
</div>
@endsection
