@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nouveau fournisseur') }}</div>

                <div class="card-body">
                    <form method="POST" action="http://monappli:3232/ajout_fournisseur">
                        @csrf

                        <div class="form-group row">
                            <label for="fournisseur_nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom fournisseur') }}</label>

                            <div class="col-md-6">
                                <input id="fournisseur_nom" type="text" class="form-control{{ $errors->has('fournisseur_nom') ? ' is-invalid' : '' }}" name="fournisseur_nom" value="{{ old('fournisseur_nom') }}" required autofocus>

                                @if ($errors->has('fournisseur_nom'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fournisseur_nom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
