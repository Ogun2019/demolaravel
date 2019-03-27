@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nouvelle action') }}</div>

                <div class="card-body">
                    <form method="POST" action="http://monappli:3232/ajout_actionIntitule">
                        @csrf

                        <div class="form-group row">
                            <label for="action_nom" class="col-md-4 col-form-label text-md-right">{{ __('Intitulé de l\'action' )}}</label>

                            <div class="col-md-6">
                                <input id="action_nom" type="text" class="form-control{{ $errors->has('action_nom') ? ' is-invalid' : '' }}" name="action_nom" value="{{ old('action_nom') }}" required autofocus>

                                @if ($errors->has('action_nom'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('action_nom') }}</strong>
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
