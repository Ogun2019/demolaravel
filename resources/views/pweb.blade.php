<?php ?>

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
                        <h4 class="text-center p-1">Web</h4>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="slidePrincipale" >Slide principale</label>
                                <input class="form-control" name="slidePrincipale" id="slidePrincipale" type="text" placeholder="" required>
                                <b class="form-text text-danger" id="" ></b>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="blockhp">Block HP</label>
                                <input class="form-control" id="blockhp" name="blockhp" type="text" placeholder="" required>
                                <b class="form-text text-danger" id="" ></b>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="layer">Layer</label>
                                <input class="form-control" name="layer" id="layer" type="text" placeholder="" required>
                                <b class="form-text text-danger" id=""></b>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="banncat">Bannière catégorie</label>
                                <input class="form-control" id="banncat" name="banncat" type="text" placeholder="" required>
                                <b class="form-text text-danger" id="" ></b>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="id_label">Label</label>
                                <input class="form-control" type="text" id="id_label" name="id_label" placeholder="" required>
                                <b class="form-text text-danger" id=""></b>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="refdecolisees">Réfs décolisées</label>
                                <input class="form-control" type="text" id="refdecolisees" name="refdecolisees" placeholder="" required>
                                <b class="form-text text-danger" id=""></b>
                            </div>
                            <button class="btn btn-success" id="valid-form-pweb" name="valider" type="submit">Valider</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>        
    </div>
</div>
@endsection