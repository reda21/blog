@extends('layouts.template')

@section("breadcrumb")
    {!! Breadcrumbs::render('profile', $user->username) !!}
@endsection

@section('content')
    <div class="col">
        <div class="row">
            <div class="divide30"></div>
            <div class="col">
                <div class="card profile">
                    <img src="http://webmx2018.me/img/photo1.jpg" class="card-img-top" alt="...">
                    <div class="card-body pt-5 pb-0">
                        <img src="http://webmx2018.me/img/profil/default.jpg" alt="profile-image"
                             class="card-image-profile">
                        <h5 class="card-title">
                            <i class="fa fa-circle text-success"></i>
                            <a href="{{$user->present()->urlProfile}}">{{$user->username}}</a>
                            <span>({{$user->roleName}})</span>
                        </h5>
                        <friends url="{{$user->present()->urlProfile}}" :follows-nbr="{{$user->followers()->count()}}"
                                 :following-nbr="{{$user->following()->count()}}"
                                 :user="{id:{{$user->id}},username:'{{$user->username}}'}"
                                 :follow="{{Auth::user()->isFollowing($user)? 1 : 0}}">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="description-block text-center">
                                                <h5 class="description-header">
                                                    <a href="http://webmx2018.me/user/redmax/followers">{{$user->followers()->count()}}</a>
                                                </h5>
                                                <span class="description-text">Abonnements</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="description-block text-center">
                                                <h5 class="description-header">
                                                    <a href="http://webmx2018.me/user/redmax/following">{{$user->following()->count()}}</a>
                                                </h5>
                                                <span class="description-text">Abonnés</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::id() != $user->id)
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-secondary btn-block">
                                                    <i class="fa fa-user"></i> Suivre
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-primary btn-block">
                                                    <i class="fa fa-envelope"></i> Message
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </friends>
                        <div class="box-menu">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="nav-scroller py-1 mb-2">
                                        <nav class="nav d-flex flex-row">
                                            <a href="http://webmx2018.me/user/redmax" class="p-2 active">
                                                <i class="fa fa-home"></i>Profil
                                            </a>
                                            <a href="http://webmx2018.me/user/redmax/friends" class="p-2">
                                                <i class="fa fa-user"></i>Ses Amis
                                            </a>
                                            <a href="http://webmx2018.me/user/redmax/tutoriels" class="p-2">
                                                <i class="fa fa-user"></i>Ses Titoriels
                                            </a>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">
                                    Card title
                                </h5>
                            </div>
                            <div>
                                <div class="dropup">
                                    <a class="btn btn-link after-none dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 offset-md-2 ">
                                <div class="profile-body">
                                    <div class="profile-feilds">
                                        <p class="labels"><span class="fa fa-user"></span> Nom</p>
                                        <p class="value">{{$user->last_name}}</p>
                                    </div>
                                </div>
                                <div class="profile-body">
                                    <div class="profile-feilds">
                                        <p class="labels"><span class="fa fa-user"></span> Prenom</p>
                                        <p class="value">{{$user->first_name}}</p>
                                    </div>
                                </div>
                                <div class="profile-body">
                                    <div class="profile-feilds">
                                        <p class="labels"><span class="fa fa-birthday-cake"></span> Date de naissance
                                        </p>
                                        <p class="value">{{$user->profile->birthday ? $user->profile->birthday->formatLocalized('%d/%m/%Y') : "--"}}</p>
                                    </div>
                                </div>
                                <div class="profile-body">
                                    <div class="profile-feilds">
                                        <p class="labels"><span class="fa fa-venus-mars"></span> Gendre</p>
                                        <p class="value">{{App\Services\Liste::GetSexe($user->profile->sexe)}}</p>
                                    </div>
                                </div>
                                <div class="profile-body">
                                    <div class="profile-feilds">
                                        <p class="labels"><span class="fa fa-flag"></span> Pays</p>
                                        <p class="value">{{App\Services\Liste::GetContry($user->profile->location ?? "default")}}</p>
                                    </div>
                                </div>
                                @if($user->email_show)
                                    <div class="profile-body">
                                        <div class="profile-feilds">
                                            <p class="labels"><span class="fa fa-user"></span> Email</p>
                                            <p class="value"><a href="mailto:{{$user->email}}">{{$user->email}}</a></p>
                                        </div>
                                    </div>
                                @endif
                                <ul class="text-center list-inline social-1">
                                    @if($user->profile->facebook_username != "")
                                        <li>
                                            <a class="btn btn-fb btn-outline-facebook rounded-circle"
                                               href="http://www.facebook.com/{{$user->profile->facebook_username}}">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if (true or $user->profile->twitter_username != "")
                                        <li>
                                            <a class="btn btn-tw btn-outline-twitter rounded-circle"
                                               href="http://www.twitter.com/{{$user->profile->twitter_username}}">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($user->profile->google_plus_username != "" or true)
                                        <li>
                                            <a class="btn btn-go btn-outline-google_plus rounded-circle"
                                               href="http://www.plus.google.com/{{$user->profile->google_plus_username}}">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($user->profile->pinterest_username != "" or true)
                                        <li>
                                            <a class="btn btn-pt btn-outline-pinterest rounded-circle"
                                               href="http://www.pinterest.com/{{$user->profile->pinterest_username}}">
                                                <i class="fa fa-pinterest"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($user->profile->github_username != "" or true)
                                        <li>
                                            <a class="btn btn-dr btn-outline-dribbble rounded-circle"
                                               href="http://www.dribbble.com/{{$user->profile->github_username}}">
                                                <i class="fa fa-dribbble"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    import Friends from "../../js/components/friends";

    export default {
        components: {Friends}
    }
</script>
