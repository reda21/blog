@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="login-form">
                <h3 class="omb_authTitle">Inscription <a href="{!!route('login')!!}">Connection</a></h3>
                <div class="row">
                    <div class="col">
                        @include("bootstrap.button.socialeConnecteButton", ["url" =>route('social.redirect',['facebook']),
                                  "label" => "Facebook", "icone" => "fa-facebook", "class" => "btn-fb-login"])
                    </div>
                    <div class="col">
                        @include("bootstrap.button.socialeConnecteButton", ["url" =>route('social.redirect',['github']),
                                  "label" => "Github", "icone" => "fa-github", "class" => "btn-gb-login"])
                    </div>
                    <div class="col">
                        @include("bootstrap.button.socialeConnecteButton", ["url" =>route('social.redirect',['google']),
                                  "label" => "Google", "icone" => "fa-google", "class" => "btn-google-login"])
                    </div>
                </div>
                <div class="row">
                    <div class="omb_loginOr">
                        <div class="col-12">
                            <hr class="omb_hrOr">
                            <span class="omb_spanOr">ou</span>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @include("bootstrap.form.text", ["name" => "username","label" => "Login d'Utilisateur",
                           'placeholder' => "Entrer ton Nom d'utilisateur", "value" => old('username')])
                    @include("bootstrap.form.email", ["name" => "email","label" => "Adresse Email",
                           'placeholder' => "Entrer ton Adresse Email", "value" => old('username')])
                    @include("bootstrap.form.text", ["name" => "first_name","label" => "Login d'Utilisateur",
                           'placeholder' => "Entrer ton Prénom", "value" => old('first_name')])
                    @include("bootstrap.form.text", ["name" => "last_name","label" => "Prénom",
                           'placeholder' => "Entrer ton Nom Famille", "value" => old('last_name')])
                    @include("bootstrap.form.password", ["name" => "password","label" => "Mot de passe",
                           'placeholder' => "Entrer ton mot de passe"])
                    @include("bootstrap.form.password", ["name" => "password_confirm","label" => "Confirmation du mot de passe",
                           'placeholder' => "Confirmer le mot de passe"])
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-theme-bg">
                                S'inscrire
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
