@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="login-form">
                <h3 class="omb_authTitle">Réinitialiser le mots de passe</h3>
                @include("bootstrap.element.alert")
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    @include("bootstrap.form.email", ["name" => "email","label" => "Adresse Email",
                                'placeholder' => "Entrer ton Adresse Email", "value" => old('email')])
                    @include("bootstrap.form.password", ["name" => "password","label" => "Mot de passe",
                           'placeholder' => "Entrer ton mot de passe"])
                    @include("bootstrap.form.password", ["name" => "password_confirmation","label" => "Confirmation du mot de passe",
                           'placeholder' => "Confirmer le mot de passe"])
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-theme-bg">
                                Réinitialiser le mots de passe
                            </button>
                        </div>
                    </div>
                    <div class="etc-login-form">
                        <p>Vous avez déjà un compte? <a href="{!!route('login')!!}">Connectez-vous ici</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
