@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="login-form">
                <h3 class="omb_authTitle">Réinitialiser le mots de passe</h3>
                Please confirm your password before continuing.
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    @include("bootstrap.form.password", ["name" => "password","label" => "Mot de passe",
                           'placeholder' => "Entrer ton mot de passe"])
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-theme-bg">
                                Confirmez le mot de passe
                            </button>
                        </div>
                    </div>
                    <div class="etc-login-form">
                        <p>Mot de passe oublié?
                            <a href="{{ route('password.request') }}">cliquez içi</a>
                        </p>
                        <p>Vous avez déjà un compte? <a href="{!!route('login')!!}">Connectez-vous ici</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
