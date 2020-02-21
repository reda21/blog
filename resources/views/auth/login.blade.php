@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="login-form">
                <h3 class="omb_authTitle">
                    Connection ou <a href="http://webmx2018.me/register">Inscription</a>
                </h3>
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
                    <div class="col-12 text-center">
                        <span class="span">Ou</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @include("bootstrap.form.text", ["name" => "email","label" => "Nom D'utilisateur ou Adresse Email",
                            'placeholder' => "Entrer ton D'utilisateur ou ton Adress Email", "value" => old('email')])
                    @include("bootstrap.form.password", ["name" => "password","label" => "Mot de passe",
                            'placeholder' => "Entrer ton Mot de Passe"])
                    @include("bootstrap.form.checkbox", ['name'=> "remember",'label' => "Se souvenir de moi"])
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-theme-bg">Se connecter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="etc-login-form">
                <p>Mot de passe oublié?
                    <a href="{{ route('password.request') }}">cliquez içi</a>
                </p>
                <p>nouvel utilisateur? <a href="{{ route('register') }}">Créer un nouveau compte</a></p>
            </div>
        </div>
    </div>
@endsection
